<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Notifications\ModeratorPassword;
use App\Notifications\ModeratorStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModeratorController extends Controller
{

    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }

    public function index(){
        $moderators = Admin::where('role','moderator')->get();
        return view('admin.moderator',compact('moderators'));
    }

    public function getById($id){
        return Admin::where('id',$id)->first();
    }

    public function get(Request $request){
        return Admin::where('id',$request->moderatorId)->first();
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false,
                'errors'=>$validator->errors()->all()]);
        }else{
            if($request->ajax()){
                $moderator = new Admin();
                $moderator->name = $request->name;
                $moderator->email = $request->email;
                $moderator->role = "moderator";
                $moderator->password = bcrypt($request->password);
                $moderator->save();
                $moderator->notify(new ModeratorPassword($request->password));
                return response()->json(['success' => true]);
            }
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins,email,'.$request->id
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false,
                'errors'=>$validator->errors()->all()]);
        }else {
            $moderator = Admin::where('id', $request->id)->first();
            $moderator->name = $request->name;
            $moderator->email = $request->email;
            $moderator->save();
            return response()->json(['success'=>true]);
        }
    }

    public function delete(Request $request){
        $moderator = $this->getById($request->moderatorId);
        $moderator->delete();
        return "true";
    }

    public function enable(Request $request){
        $moderator = $this->getById($request->moderatorId);
        $moderator->status = 1;
        $moderator->save();
        $moderator->notify(new ModeratorStatus("Islamic Profile Enable","Enabled"));
    }
    public function disable(Request $request){
        $moderator = $this->getById($request->moderatorId);
        $moderator->status = 0;
        $moderator->save();
        $moderator->notify(new ModeratorStatus("Islamic Profile Disable","Disabled"));
    }


}
