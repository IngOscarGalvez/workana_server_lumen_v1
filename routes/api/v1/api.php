<?php

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->post('auth/login', 'Auth\V1\AuthLoginController@login');
    $router->post('auth/register', 'Auth\V1\AuthRegisterController@register');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('auth/refresh', 'Auth\V1\AuthRefreshController@refresh');
        $router->post('auth/logout', 'Auth\V1\AuthLogoutController@logout');
        $router->get('room', 'Api\V1\Room\RoomIndexController@index');
        $router->post('room', 'Api\V1\Room\RoomStoreController@store');
        $router->get('room/{id}', 'Api\V1\Room\RoomShowController@show');
        $router->post('joinMe', 'Api\V1\Room\RoomJoinMeController@joinMe');
        $router->post('giveVote', 'Api\V1\Room\RoomGiveVoteController@giveVote');
        $router->post('usersRoomVotes', 'Api\V1\Room\RoomUsersRoomVotesController@usersRoomVotes');
    });
});
