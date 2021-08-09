<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Models\Room;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RoomShowController extends Controller
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
     * show
     *
     * @param  \App\Models\Room $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $this->room = $this->room::with('users')->find($id);
        if ($this->room) {
            return $this->showData($this->room, Response::HTTP_OK);
        }
        return $this->errorResponse("The Room with id $id does not exist", Response::HTTP_NOT_FOUND);
    }
}
