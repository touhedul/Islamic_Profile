<?php

namespace App\Http\Controllers\User;

use App\Notifications\EmailVarification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class EmailVerificationController extends Controller
{
    public function verify($token)
    {

        $user = User::where('verify_token', $token)->first();
        if (!is_null($user)) {
            $user->status = 1;
            $user->verify_token = NULL;
            $user->save();
            return redirect('/')->with('success', 'Your Email is verified. Please login to continue.');
        } else {
            return redirect('/')->with('error', 'Sorry !! Your token is not matched !!');
        }
    }

    public function sendVerifyEmail($verifyEamil)
    {
        $email = Crypt::decryptString($verifyEamil);
        $user = User::where('email',$email)->first();
        $user->verify_token = Str::random(40);//create the verify token
        $user->save();
        $user->notify(new EmailVarification($user));
        return back()->with('success','A verification Email Send to you email. Please Confirm your email to continue.');
    }
}
