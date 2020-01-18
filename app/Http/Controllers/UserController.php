<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use  App\User;
use  App\Referral;

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


    public function  addReferral($id)
    {
        if (Auth::check()) {

            $my_ref = new Referral;
            $user_id = Auth::id();

            // Check if I am not referral;
             $count = $my_ref::where('child_ID', '=', $user_id)->count();

             $parent_count = $my_ref::where('child_ID', '=', $id)->count();
             if ($parent_count > 0)
                 {
                     return response()->json(['You Parent is added as Child'], 200);
                 }
             if ($count > 0)
                {
                    return response()->json(['You cannot add another Parent referral'], 200);
                }
                else
                    {
                        try
                        {
                            $my_ref->parent_ID = $id;
                            $my_ref->child_ID = $user_id;
                            $my_ref->token_url = 'http://localhost:8000/api/token/' . $user_id;
                            $my_ref->save();
                            return response()->json(['Referral Parent is added successfully'], 200);
                        }
                            catch (\Exception $e) {
                                return response()->json(['message' => ('Referand add Failed! for user:' . $user_id . $e->getMessage() )], 409);
                        }
                    }
            // End check -------;
        }
        else
            return response()->json(['token_invalid'], 500);
    }
}
