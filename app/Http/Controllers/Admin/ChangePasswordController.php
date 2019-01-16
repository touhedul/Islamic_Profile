<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }


    public function index()
    {
        return view('admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'min:6|required|string|confirmed',

        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        } else {
            $admin = Admin::find(Auth::id());

            if (Hash::check($request->oldpassword, $admin->password)) {
                $admin->password = Hash::make($request->password);
                $admin->save();
                return response()->json(['success' => true]);
            } else {
                $errors = array("Your old Password doesn't match.");
                return response()->json([
                    'errors' => $errors,
                    'success' => false]);
            }


        }
    }
}
