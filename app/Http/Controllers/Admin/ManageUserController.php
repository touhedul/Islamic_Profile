<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\User\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageUserController extends Controller
{
    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }

    public function index(){
        $users = User::all();
        return view('admin.user-manage',compact('users'));
    }


    public function getById($id){
        return User::where('id',$id)->first();
    }

    public function enable(Request $request){
        $user = $this->getById($request->userId);
        $user->status = 1;
        $user->save();
    }
    public function disable(Request $request){
        $user = $this->getById($request->userId);
        $user->status = 0;
        $user->save();
    }

    public function delete(Request $request){
        $user = $this->getById($request->userId);
        $userProfile = UserProfile::where('user_id',$request->userId)->first();
        $userProfile->delete();
        $user->delete();
        return "true";
    }
}
