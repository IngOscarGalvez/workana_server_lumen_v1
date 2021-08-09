<?php

namespace App\Http\Controllers\api\v1\room;

use App\Models\Room;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\room\AllVoteColletion;
use App\Http\Requests\Api\V1\Room\usersRoomVotesRequest;

class RoomUsersRoomVotesController extends Controller
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

    public function usersRoomVotes(usersRoomVotesRequest $request): JsonResponse
    {
        $this->room = $this->room->find($request->room_id);
        $usersVote = AllVoteColletion::collection($this->room->usersVoted);
        $avgVotes = collect($usersVote)->avg('vote_value');
        return $this->showData(
            [
                'users' => $usersVote,
                'n_users' => count($usersVote),
                'avg_votes' => $avgVotes ?? 0
            ],
            Response::HTTP_OK
        );
    }
}
