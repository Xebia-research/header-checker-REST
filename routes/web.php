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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('requests', function () use ($router) {
    return 'get.requests';
});
$router->get('requests/{requestId:[0-9]+}', function ($requestId) use ($router) {
    return "get.requests.{$requestId}";
});
$router->post('requests', function () use ($router) {
    return 'post.requests';
});

$router->group(['prefix' => 'requests/{requestId:[0-9]+}'], function ($requestId) use ($router) {
    $router->get('responses', function ($requestId) use ($router) {
        return "get.requests.{$requestId}.responses";
    });
    $router->get('responses/{responseId:[0-9]+}', function ($requestId, $responseId) use ($router) {
        return "get.requests.{$requestId}.responses.{$responseId}";
    });
});
