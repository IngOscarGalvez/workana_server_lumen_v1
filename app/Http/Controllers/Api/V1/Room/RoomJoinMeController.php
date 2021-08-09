<?php

namespace App\Http\Controllers\Api\V1\Room;

use App\Models\Room;
use App\Models\User;
use App\Models\RoomUser;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Room\JoinMeRequest;
use App\Services\RoomServices;

class RoomJoinMeController extends RoomServices
{
    use ApiResponser;

    /**
     * @var Room
     */
    protected $room;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var RoomUser
     */
    protected $roomUser;
    /**
     * @var RoomReposository
     */


    /**
     * __construct
     *
     * @param Room $room
     * @param User $user
     * @param RoomUser $roomUser
     * @param RoomHelpers $roomHelper
     */
    public function __construct(Room $room, User $user, RoomUser $roomUser)
    {
        $this->room = $room;
        $this->user = $user;
        $this->roomUser = $roomUser;
    }

    /**
     * joinMe
     *
     * @param JoinMeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function joinMe(JoinMeRequest $request): JsonResponse
    {
        try {
            $check_user = $this->checkRoomUser($request->room_id, $request->user_id);
            if ($check_user) {
                return $this->errorResponse("The user is joined to the room", Response::HTTP_FORBIDDEN);
            }
            return $this->attachRoomUser($request->room_id, $request->user_id);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
