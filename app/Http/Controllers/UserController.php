<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use  App\User;
use  App\Referral;
use  App\Checkout;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */

    public function allUsers()
    {
        return response()->json(['users' =>  User::all()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */

    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }

    }

    public function  addReferral($id)
    {
        if (Auth::check()) {

            $my_ref = new Referral;
            $user_id = Auth::id();

            // Check if I am not referral;
             $count = $my_ref::where('child_ID', '=', $user_id)->count();

                if ($count > 0)
                    {
                        return response()->json(['You cannot add another referral'], 200);
                    }
                else
                    {
                        try
                        {
                            $my_ref->parent_ID = $id;
                            $my_ref->child_ID = $user_id;
                            $my_ref->token_url = 'http://localhost:8000/api/token/' . $user_id;
                            $my_ref->save();
                            return response()->json(['Referral is added successfully'], 200);
                        }
                            catch (\Exception $e) {
                                return response()->json(['message' => ('Referal add Failed! for user:' . $user_id . $e->getMessage() )], 409);
                        }
                    }
            // End check -------;
        }
        else
            return response()->json(['token_invalid'], 500);

    }
}
