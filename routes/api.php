<?php

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('requests', [
        'as' => 'api.requests.index',
        'uses' => 'RequestsController@index',
    ]);

    $router->get('requests/{requestId:[\d]+}', [
        'as' => 'api.requests.show',
        'uses' => 'RequestsController@show',
    ]);

    $router->post('requests/batch', [
        'as' => 'api.requests.store_batch',
        'uses' => 'RequestsController@storeBatch',
    ]);

    $router->post('requests', [
        'as' => 'api.requests.store',
        'uses' => 'RequestsController@store',
    ]);
});