<?php

use App\Models\Room;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoomTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRoomCreate()
    {
        Room::factory()->create([
            'name' => 'test_room'
        ]);

        $this->seeInDatabase('rooms', ['name' => 'test_room']);
    }

    public function testRoomUpdate()
    {
        Room::factory()->create([
            'name' => 'test_room'
        ]);

        $room = Room::where('name', 'test_room')->first();
        $room->name = 'test_room_update';
        $room->save();
        $this->seeInDatabase('rooms', ['name' => 'test_room_update']);
    }

    public function testRoomDelete()
    {
        Room::factory()->create([
            'name' => 'test_room'
        ]);
        $room = Room::where('name', 'test_room')->first();
        $room->delete();
        $this->notSeeInDatabase('rooms', ['name' => 'test_room']);
    }
}
