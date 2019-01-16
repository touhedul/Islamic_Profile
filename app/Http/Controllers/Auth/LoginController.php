<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //override function
    public function showLoginForm()
    {
        abort(404);
    }
    //override function
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
    }

    //override - to change the page after logged out , admin and user logout different session
    public function logout(Request $request)
    {
//        $this->guard()->logout();
//
//        $request->session()->invalidate();
//
//        return $this->loggedOut($request) ?: redirect('/admin/login');

        $sessionKey = $this->guard()->getName();

        // Logout current user by guard
        $this->guard()->logout();

        // Delete single session key (just for this user)
        $request->session()->forget($sessionKey);

        // After logout, redirect to login screen again
        return redirect()->route('home');
    }


}

