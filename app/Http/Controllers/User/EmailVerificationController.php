<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
class EmailVerificationController extends Controller
{
    public function verify($token){

        $user = User::where('verify_token',$token)->first();
        //return $user;
        if (!is_null($user)) {
            $user->status = 1;
            $user->verify_token = NULL;
            $user->save();
            return redirect('/')->with('success','Your Email is verified. Please login to continue.');
        }else {
            return redirect('/')->with('error', 'Sorry !! Your token is not matched !!');
        }
    }
}
