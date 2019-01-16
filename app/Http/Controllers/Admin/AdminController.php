<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }
    public function index(){
        return view('admin.index');
    }

    public function regularAdmin(){
        $regularAdmins = Admin::where('role','admin')->get();
        return view('admin.regular-admin',compact('regularAdmins'));
    }

    public function addAdmin(Request $request){
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
                $admin = new Admin();
                $admin->name = $request->name;
                $admin->email = $request->email;
                $admin->role = "admin";
                $admin->password = bcrypt($request->password);
                $admin->save();
                return response()->json(['success' => true]);
            }
        }
    }

    public function updateAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:admins,email,'.$request->id
        ]);
        if($validator->fails()){
            return response()->json(['success'=>false,
                'errors'=>$validator->errors()->all()]);
        }else {
            $admin = Admin::where('id', $request->id)->first();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->save();
            return response()->json(['success'=>true]);
        }
    }

    public function deleteAdmin(Request $request){

        $admin = $this->getAdminById($request->adminId);
        $admin->delete();
        return "true";
    }

    public function getAdmin(Request $request){
        return $this->getAdminById($request->adminId);
    }
    public function enableAdmin(Request $request){
        $admin = $this->getAdminById($request->adminId);
        $admin->status = 1;
        $admin->save();
    }
    public function disableAdmin(Request $request){
        $admin = $this->getAdminById($request->adminId);
        $admin->status = 0;
        $admin->save();
    }

    public function getAdminById($id){
        return Admin::where('id',$id)->first();
    }

}
