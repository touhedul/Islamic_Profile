<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\User\Hadith;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HadithManageController extends Controller
{
    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }
    public function index(){
        $hadiths = Hadith::orderBy('created_at','desc')->get();
        return view('admin.hadith',compact('hadiths'));
    }
    public function getById($id){
        return Hadith::where('id',$id)->first();
    }
    public function approve(Request $request){
        $hadith = $this->getById($request->hadithId);
        $hadith->status = "approve";
        $hadith->save();
    }
    public function refuse(Request $request){
        $hadith = $this->getById($request->hadithId);
        $hadith->status = "refuse";
        $hadith->save();
    }
    public function get(Request $request){
        return $this->getById($request->hadithId);
    }
    public function delete(Request $request){
        $hadith = $this->getById($request->hadithId);
        $hadith->delete();
        return "true";
    }
    public function manage(Request $request){


        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'source' => 'required | max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        }else {
            $hadith= $this->getById($request->id);
            $hadith->description = $request->description;
            $hadith->source = $request->source;
            $hadith->save();
            return response()->json(['success'=>true]);

        }

    }
}
