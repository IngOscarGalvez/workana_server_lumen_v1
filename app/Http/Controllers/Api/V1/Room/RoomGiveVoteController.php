<?php

namespace App\Http\Controllers\api\v1\room;

use App\Models\Room;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Room\GiveVoteRequest;
use Illuminate\Http\JsonResponse;

class RoomGiveVoteController extends Controller
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
     * giveVote
     *
     * @param GiveVoteRequest $request
     * @return Illuminate\Http\JsonResponse
     */
    public function giveVote(GiveVoteRequest $request): JsonResponse
    {
        try {
            $this->room = $this->room->find($request->room_id);
            try {
                DB::transaction(function () use ($request) {
                    $this->room->users()->updateExistingPivot($request->user_id, [
                        'vote_value' => $request->vote_value,
                        'voted' => true
                    ]);
                }, 3);
            } catch (\Exception $exception) {
                return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return $this->showData(
                [
                    'message' => "Thank you, you have voted - value: {$request->vote_value}",
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
