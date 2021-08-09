<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
    protected $table = 'rooms_users';
    protected $fillable = ['room_id', 'user_id'];
}
