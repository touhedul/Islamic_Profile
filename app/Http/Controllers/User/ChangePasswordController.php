<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        UserHelper::middleware($this);
    }

    public function changePasswordView()
    {
        return view('user.change-password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required'
        ]);

        $user = User::find(Auth::id());
//        echo $request->old_password.'</br>';
//        echo Hash::make($request->old_password).'</br>';
//        echo $user->password.'<br>';

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->password == $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect('user')->with('success', 'Password Change Successful.');
            } else {

                return back()->with('error', 'Confirmation Password Mismatch.');
            }
        } else {
            return back()->with('error', 'Password Mismatch.');
        }

    }


}
