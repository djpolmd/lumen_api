<?php

namespace App\Http\Controllers;

use App\User;
use App\Referral;
use App\Checkout;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
// Composer: "fzaninotto/faker"
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


/** @var  \Illuminate\Database\Eloquent\Factory $factory */

class CheckOutController extends Controller
{
    /**
     * Store a new Checkout.
     *
     * @param  Request  $request
     * @return Response
     */

    public function PostCheckout(Request $request)
    {
        if (Auth::check()) {
            $this->validate($request, [
                'status' => 'required|string',
                'grand_total' => 'required|string',
            ]);

            try {
                $out = new Checkout;
                $userId = Auth::id();
                $current_user = User::find($userId);

                $out->user_id = $userId;
                $out->status = $request['status'];
                $out->grand_total = $request['grand_total'];

                $out->first_name = $current_user->first_name;
                $out->last_name = $current_user->last_name;
                $out->address = $current_user->email;

                //            Faker data input

                $out->trans_id = Str::random(20);

                $out->payment_status = 1;
                $out->payment_method = 'Credit Card';

                $out->city = 'Chisinau';
                $out->country = 'Moldova';
                $out->post_code = 'MD-2000';
                $out->phone_number = rand(1000 ,2);
                $out->notes = Str::random(20);
                $out->save();
            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => ('Check Out Failed! for user:' . $userId . $e->getMessage() )], 409);
            }
            return response()->json(['message' => 'Checkout was Added !'], 200);
        }
            return response()->json(['token_invalid'], 500);
        }

    public function GetCheckout()
    {
        if (Auth::check()) {

            $userId = Auth::id();
            $current_user = User::find($userId);
//          $AllOuts = Checkout::where('user_id', '=', $userId)->get();
            $AllOuts  = Checkout::select('grand_total')->where('user_id', $userId)->get();
            $out = $AllOuts->sum('grand_total');
            $current_user->balance = $out;
            $current_user->save();

            return response()-> json(['message' => ( 'You total balance is :'. ' ' . $out) ], 200);

        }  return
                response()->json(['token_invalid'], 500);
    }


}

