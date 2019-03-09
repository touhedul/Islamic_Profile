<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\Admin\Dhikr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DhikrManageController extends Controller
{

    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }


    public function getById($id){
        return Dhikr::where('id',$id)->first();
    }
    public function get(Request $request){
        return $this->getById($request->dhikrId);
    }

    public function index(){
        $dhikrs = Dhikr::all();
        return view('admin.dhikr',compact('dhikrs'));
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        }else {
            $dhikr = new Dhikr();
            $dhikr->name = $request->name;
            $dhikr->save();
            return response()->json(['success'=>true]);

        }
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        }else {
            $dhikr =$this->getById($request->id);
            $dhikr->name = $request->name;
            $dhikr->save();
            return response()->json(['success'=>true]);

        }
    }

    public function delete(Request $request){
        $dhikr = $this->getById($request->dhikrId);
        $dhikr->delete();
        return "true";
    }


}
