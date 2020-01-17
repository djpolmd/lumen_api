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
    $out = '';
    for($i=0; $i < 40; $i++)
        {
            $user_id = \App\User::all()->random()->id;
            $count = \App\Referral::where('child_ID', '=', $user_id)->count();

            while ($count > 0)
                {
                    $user_id = \App\User::all()->random()->id;
                    $count = \App\Referral::where('child_ID', '=', $user_id)->count();
                  $out = $out . ' whose in while';
                }

                $out = $out . ' <br> ' . $user_id . ' - '. $count;

        }

    return $out;
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

    $router->post('checkout', 'CheckOutController@PostCheckout' );

});


