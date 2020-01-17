<?php



use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => "John",
        'last_name' => "Doe",
        'email' => "test@test.com",
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(20),
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Checkout::class, function (Faker $faker) {
    $status = array('pending', 'processing', 'completed', 'decline');

    return [
        'trans_id' => $faker->unique()->uuid,
        'user_id' => User::all()->random()->id,
        'status' => $status[array_rand($status)],
        'grand_total' => $faker->randomNumber(5,false) / rand(1,9),
        'payment_status' => 1,
        'payment_method' => $faker->creditCardType,

        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'address'    => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'post_code' => $faker->postcode,
        'phone_number' => $faker->phoneNumber,
        'notes' => $faker->text,
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Referral::class, function (Faker $faker) {

    $user_id = \App\User::all()->random()->id;
    $count = \App\Referral::where('child_ID', '=', $user_id)->count();

    while ($count > 0)
    {
        $user_id = \App\User::all()->random()->id;
        $count = \App\Referral::where('child_ID', '=', $user_id)->count();
//        $out = $out . ' whose in while';
    }

    return [
        'parent_ID' => User::all()->random()->id,
        'child_ID' => $user_id,
        'token_url' => 'http://localhost:8000/api/token&' . $user_id,
    ];
});
