<?php

namespace App\Http\Resources\v1\room;

use Illuminate\Http\Resources\Json\JsonResource;

class AllVoteColletion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $data = [
            'user_id' => $this->id,
            'user_name' => $this->name,
            'voted' => $this->pivot->voted,
            'vote_value' => $this->pivot->vote_value
        ];

        return $data;
    }
}
