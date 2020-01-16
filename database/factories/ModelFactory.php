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
        'name' => "John Doe",
        'email' => "test@test.com",
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),

    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(20),
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */


$factory->define(App\Checkout::class, function (Faker $faker) {
    $status = array('pending', 'processing', 'completed', 'decline');
    return [
        'trans_id' => Str::random(10) . '_' . Str::random(10),
        'user_id' => User::all()->random()->id,
        'status' => $status[array_rand($status)],
        'grand_total' => $faker->randomNumber(5,false),
        'payment_status' => 1,
        'payment_method' => $faker->creditCardType,

        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'post_code' => $faker->postcode,
        'phone_number' => $faker->phoneNumber,
        'notes' => $faker->text,
    ];
});
