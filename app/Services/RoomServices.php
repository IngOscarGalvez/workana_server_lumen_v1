<?php

namespace App\Services;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoomServices extends Controller
{

    use ApiResponser;

    /**
     * checkRoomUser
     *
     * @param Room $room_id
     * @param User $user_id
     * @return boolean
     */
    public function checkRoomUser($room_id, $user_id): bool
    {
        $this->roomUser = $this->roomUser
            ->where([
                ['user_id', $user_id],
                ['room_id', $room_id]
            ])->first();

        if ($this->roomUser) {
            return true;
        }
        return false;
    }

    /**
     * attachRoomUser
     *
     * @param Room $room_id
     * @param User $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachRoomUser($room_id, $user_id): JsonResponse
    {
        try {
            $this->room = $this->room->find($room_id);
            DB::transaction(function () use ($user_id) {
                $this->room->users()->attach($user_id, [
                    'vote_value' => 0,
                    'voted' => false
                ]);
            }, 3);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $this->user = $this->user->find($user_id);
        $data = [
            'user_joined' => $this->user,
            'room_id' => $room_id
        ];
        return $this->showData($data, Response::HTTP_CREATED);
    }
}
