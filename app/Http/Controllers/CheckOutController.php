<?php

use App\User;
use App\Referral;
use App\Checkout;
use Illuminate\Http\Request;

namespace App\Http\Controllers;




class CheckOutController extends Controller
{

    public function PostCheckout(Request $request)
    {
        $his->validate($request, [
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
            ]);
    }

    public function GetCheckout($id)
    {
        //
    }


}
