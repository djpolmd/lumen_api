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

$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->get('user/profile', function () {
        return Auth::user();
        // Uses Auth Middleware
    });
});

//API group
$router->group(['prefix' => 'api'], function () use ($router) {

    // Matches "/api/register
    $router->post('register', 'AuthController@register');

});
