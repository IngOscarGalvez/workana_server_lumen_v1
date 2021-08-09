<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Models\Room;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RoomIndexController extends Controller
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
     * index
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->room = $this->room::all();
        return $this->showData($this->room, Response::HTTP_OK);
    }
}
