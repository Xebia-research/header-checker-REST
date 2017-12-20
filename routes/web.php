<?php

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('requests/{requestId:[\d]+}', [
        'as' => 'api.requests.show',
        'uses' => 'RequestsController@show',
    ]);
});
