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


    return " Рекрутер спрашивает у Сократа — знает ли он Пайтон?
— Знаю ли я?.. Я скажу вам так, пацаны, я знаю, что ничего не знаю ";
});

//$router->group(['middleware' => 'auth'], function () use ($router) {
//
//    $router->get('user/profile', function () {
//        return Auth::user();
//        // Uses Auth Middleware
//    });
//});

//API group
$router->group(['prefix' => 'api'], function () use ($router) {

    // Matches "/api/register"
    $router->post('register', 'AuthController@register');
    // Matches "/api/login"
    $router->post('login', 'AuthController@postLogin');
    // Matches "/api/profile"
    $router->get('profile', 'UserController@profile');
    // Matches "/api/users/1"
    $router->get('users/{id}', 'UserController@singleUser');
    // Matches "/api/users"
    $router->get('users', 'UserController@allUsers');
    // Matches "/api/checkout  - checkout from bank account and supply for local account"
    $router->post('checkout', 'CheckOutController@PostCheckout' );

    // Matches "/api/getbalance   - get balance from current account "
    $router->get('getbalance', 'CheckOutController@GetCheckout' );

    // Matches "/api/token/N   - register referral relationship "

    $router->get('token/{id}', 'UserController@addReferral');

});


