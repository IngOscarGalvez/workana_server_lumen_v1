<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Models\Room;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Room\RoomRequest;



class RoomStoreController extends Controller
{
    use ApiResponser;

    /**
     * @var Room
     */
    protected $room;
    /**
     * __construct
     *
     * @param Room $room
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RequestsRoom  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoomRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $this->room = $this->room::create($request->validated());
            }, 3);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->showData($this->room, Response::HTTP_CREATED);
    }
}
