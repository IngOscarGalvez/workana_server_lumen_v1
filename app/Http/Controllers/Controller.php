<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *   title="Workana Server API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="oscargalvez1992@gmail.com",
 *     name="Ingeniero Oscar Galvez"
 *   )
 * )
 */
class Controller extends BaseController
{
    //
}

/**
 * @OA\Get(
 *     path="/api/v1/room/{id}",     *
 *     tags={"Room"},
 *     summary="Find Room",
 *     @OA\Parameter(
 *         name="Room Id",
 *         in="path",
 *         description="Room Id",
 *         required=true,
 *         @OA\Schema(type="number")
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="Returns Room find id",
 *         @OA\JsonContent(
 *              example= {"status":"Success","code":200,"messages":{},"result":{"id":1,"name":"Issue 1","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z","users":{{"id":1,"name":"admin","email":"admin@admin.com","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z","pivot":{"room_id":1,"user_id":1,"vote_value":5,"voted":1}}}}}
 *         )
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Not find Room",
 *         @OA\JsonContent(
 *              example= {"status":"Error","code":404,"messages":"The Room with id 100 does not exist","result":{}}
 *         )
 *     ),
 * )
 */
/**
 * @OA\Post(
 *     path="/api/v1/room",
 *     tags={"Room"},
 *     summary="Add new Room",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(     *
 *                 @OA\Property(
 *                     property="name",
 *                     type="string"
 *                 ),
 *
 *                 example={"name": "Room 1"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Room Created",
 *         @OA\JsonContent(
 *               example={"status": "Success","code": 201, "messages": {}, "result": {  "name": "Room 1", "updated_at": "2021-07-31T05:08:40.000000Z",  "created_at": "2021-07-31T05:08:40.000000Z", "id": 8 }},
 *          ),
 *
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Request Invalid",
 *         @OA\JsonContent(
 *               example={"message":"The given data was invalid.","Errors":{"name":{"The name field is required."}}},
 *
 *          ),
 *
 *     ),
 *
 *
 * )
 */
/**
 * @OA\Get(
 *     path="/api/v1/room",
 *     tags={"Room"},
 *     summary="List all Rooms",
 *
 *     @OA\Response(
 *         response=200,
 *         description="List all Rooms",
 *         @OA\JsonContent(
 *               example={"status":"Success","code":200,"messages":{},"result":{{"id":1,"name":"Issue 1","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z"},{"id":2,"name":"Issue 2","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z"},{"id":3,"name":"Issue 3","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z"},{"id":4,"name":"Issue 4","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z"},{"id":5,"name":"Issue 5","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z"}}},
 *          ),
 *
 *     )
 * )
 */
/**
 * @OA\Post(
 *     path="/api/v1/joinMe",
 *     tags={"Room"},
 *     summary="Join Me Room ",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="user_id",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="room_id",
 *                     type="number"
 *                 ),
 *
 *                 example={"user_id": 1,"room_id":1}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User Join Me Room",
 *         @OA\JsonContent(
 *               example={"status":"Success","code":201,"messages":{},"result":{"user_joined":{"id":1,"name":"admin","email":"admin@admin.com","created_at":"2021-07-31T03:33:53.000000Z","updated_at":"2021-07-31T03:33:53.000000Z"},"room_id":"1"}},
 *          ),
 *
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Request Invalid",
 *         @OA\JsonContent(
 *               example={"message":"The given data was invalid.","Errors":{"user_id":{"The selected user id is invalid."},"room_id":{"The selected room id is invalid."}}},
 *
 *          ),
 *
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="User Join Invalid",
 *         @OA\JsonContent(
 *               example={"status":"Error","code":403,"messages":"The user is joined to the room","result":{}},
 *
 *          ),
 *
 *     ),
 *
 *
 * )
 */
/**
 * @OA\Post(
 *     path="/api/v1/giveVote",
 *     tags={"Room"},
 *     summary="Vote User",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="user_id",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="room_id",
 *                     type="number"
 *                 ),
 *                 @OA\Property(
 *                     property="vote_value",
 *                     type="number"
 *                 ),
 *
 *                 example={"user_id": 1,"room_id":1,"vote_value":13}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Sucess Vote User",
 *         @OA\JsonContent(
 *               example={"status":"Success","code":201,"messages":{},"result":{"message":"Thank you, you have voted - value: 5"}},
 *          ),
 *
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Request Invalid",
 *         @OA\JsonContent(
 *               example={"message":"The given data was invalid.","Errors":{"user_id":{"The selected user id is invalid."},"room_id":{"The selected room id is invalid."}}},
 *
 *          ),
 *
 *     ), *
 *
 *
 * )
 */
/**
 * @OA\Post(
 *     path="/api/v1/usersRoomVotes",
 *     tags={"Room"},
 *     summary="Users Voted by Room",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema( *
 *                 @OA\Property(
 *                     property="room_id",
 *                     type="number"
 *                 ), *
 *
 *                 example={"room_id":1}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sucess Users Voted by Room",
 *         @OA\JsonContent(
 *               example={"status":"Success","code":200,"messages":{},"result":{"users":{{"user_id":1,"user_name":"admin","voted":1,"vote_value":5}},"n_users":1,"avg_votes":5}},
 *          ),
 *
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Request Invalid",
 *         @OA\JsonContent(
 *               example={"message":"The given data was invalid.","Errors":{"room_id":{"The selected room id is invalid."}}},
 *
 *          ),
 *
 *     ), *
 *
 *
 * )
 */
