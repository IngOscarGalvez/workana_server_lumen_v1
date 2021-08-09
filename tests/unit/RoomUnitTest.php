<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class RoomUnitTest extends TestCase
{
    use DatabaseMigrations;

    public function loginToken()
    {
        $response = $this->call(
            'POST',
            '/api/v1/auth/login',
            [
                'email' => 'admin@admin.com',
                'password' => '1234aA!64'
            ]
        );

        $login = $response->getData();

        return $login->result->access_token;
    }

    public function testRoomIndex()
    {

        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'GET',
            '/api/v1/room',
            [],
            [],
            [],
            $transformedServer
        );

        $this->assertEquals(200, $response->status());
    }

    public function testRoomIndexfailUnauthorized()
    {
        $response = $this->call(
            'GET',
            '/api/v1/room',
        );

        $this->assertEquals(401, $response->status());
    }

    public function testRoomStore()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/room',
            [
                'name' => 'test_room'
            ],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('rooms', ['name' => 'test_room']);
    }

    public function testRoomStorefailUnauthorized()
    {
        $response = $this->call(
            'POST',
            '/api/v1/room',
        );

        $this->assertEquals(401, $response->status());
    }

    public function testRoomStorFailUnprocessableEntity()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/room',
            [],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(422, $response->status());
    }


    public function testRoomShow()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'GET',
            '/api/v1/room/1',
            [],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(200, $response->status());
    }

    public function testRoomShowfailUnauthorized()
    {
        $response = $this->call(
            'GET',
            '/api/v1/room/1',
        );

        $this->assertEquals(401, $response->status());
    }

    public function testRoomShowFailNotFound()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'GET',
            '/api/v1/room/999999',
            [],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(404, $response->status());
    }

    public function testRoomJoinMe()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/joinMe',
            [
                'user_id' => 1,
                'room_id' => 1
            ],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(201, $response->status());

        $response = $this->call(
            'POST',
            '/api/v1/joinMe',
            [
                'user_id' => 1,
                'room_id' => 1
            ],
            [],
            [],
            $transformedServer
        );

        $this->assertEquals(403, $response->status());
    }

    public function testRoomJoinMefailUnauthorized()
    {
        $response = $this->call(
            'POST',
            '/api/v1/joinMe',
        );

        $this->assertEquals(401, $response->status());
    }

    public function testRoomJoinMeFailUnprocessableEntity()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/joinMe',
            [],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(422, $response->status());
    }

    public function testRoomGiveVote()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/giveVote',
            [
                'user_id' => 1,
                'room_id' => 1,
                'vote_value' => 13
            ],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(201, $response->status());
    }

    public function testRoomGiveVotefailUnauthorized()
    {
        $response = $this->call(
            'POST',
            '/api/v1/giveVote',
        );

        $this->assertEquals(401, $response->status());
    }

    public function testRoomGiveVoteFailUnprocessableEntity()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/giveVote',
            [],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(422, $response->status());
    }

    public function testRoomUsersRoomVotes()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/usersRoomVotes',
            [
                'room_id' => 1
            ],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(200, $response->status());
    }

    public function testRoomUsersRoomVotesfailUnauthorized()
    {
        $response = $this->call(
            'POST',
            '/api/v1/usersRoomVotes',
        );

        $this->assertEquals(401, $response->status());
    }

    public function testRoomUsersRoomVotesFailUnprocessableEntity()
    {
        $server = [
            'Authorization'  => 'bearer ' . $this->loginToken()
        ];
        $transformedServer = $this->transformHeadersToServerVars($server);

        $response = $this->call(
            'POST',
            '/api/v1/usersRoomVotes',
            [],
            [],
            [],
            $transformedServer
        );
        $this->assertEquals(422, $response->status());
    }
}
