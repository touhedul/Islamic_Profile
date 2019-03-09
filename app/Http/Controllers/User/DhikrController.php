<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Models\Admin\Dhikr;
use App\Models\User\UserDhikr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DhikrController extends Controller
{

    public function __construct()
    {
        UserHelper::middleware($this);
    }

    public function dhikrIndex(){
        $dhikrs = Dhikr::all();
        $userDhikrs = UserDhikr::where('user_id',Auth::id())->get();
       // return $dhikrs;
        return view('user.dhikr',compact('dhikrs','userDhikrs'));
    }

    public function saveOrUpdateDhikr(Request $request){
       $dhikrId = $request->dhikrId;
       $dhikrCount = $request->numberOfCount;
       $userDhikr = UserDhikr::where('user_id',Auth::id())->where('dhikr_id',$dhikrId)->first();
       if($userDhikr){
           $previousDhikrCount = $userDhikr->dhikr_count;
           $newCount = $previousDhikrCount + $dhikrCount;
           $userDhikr->dhikr_count = $newCount;
           $userDhikr->save();
           return "update";
       }else{
           $newUserDhikr = new UserDhikr;
           $newUserDhikr->user_id = Auth::id();
           $newUserDhikr->dhikr_id = $dhikrId;
           $newUserDhikr->dhikr_count = $dhikrCount;
           $newUserDhikr->save();
           return "create";
       }
    }

    public function userDhikr(Request $request){
        $userDhikr = UserDhikr::where('user_id',Auth::id())->where('dhikr_id',$request->dhikr_id)->first();
        $dhikrCount = $userDhikr->dhikr_count;
        $dhikrName = $userDhikr->dhikrs($userDhikr->dhikr_id)->name;
        $ud = array(
            'dhikrCount'=>$dhikrCount,
            'dhikrName'=>$dhikrName,
        );
        return $ud;// $userDhikr->dhikr_count;
    }
}
