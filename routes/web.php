<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['middleware' => 'auth', 'namespace' => 'Api', 'prefix'=>'api'], function () use ($router) {
    $router->get('requests', [
        'as' => 'api.requests.index',
        'uses' => 'RequestApiController@index',
    ]);

    $router->get('requests/{requestId:[\d]+}', [
        'as' => 'api.requests.show',
        'uses' => 'RequestApiController@show',
    ]);

    $router->post('requests/batch', [
        'as' => 'api.requests.store_batch',
        'uses' => 'RequestApiController@storeBatch',
    ]);

    $router->post('requests', [
        'as' => 'api.requests.store',
        'uses' => 'RequestApiController@store',
    ]);
});
