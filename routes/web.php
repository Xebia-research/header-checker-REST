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

$router->group(['middleware' => 'auth', 'namespace' => 'Api'], function () use ($router) {
    $router->get('/', [
        'as' => 'api.welcome',
        'uses' => 'DefaultApiController@showWelcomeMessage',
    ]);

    $router->get('requests[/{format}]', [
        'as' => 'api.requests.index',
        'uses' => 'RequestApiController@indexAllRequests',
    ]);

    $router->get('requests/{requestId:[0-9]+}[/{format}]', [
        'as' => 'api.requests.show',
        'uses' => 'RequestApiController@showSingleRequest',
    ]);

    $router->post('requests', [
        'as' => 'api.requests.store',
        'uses' => 'RequestApiController@storeRequest',
    ]);
});