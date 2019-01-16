<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Models\User\Salat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalatController extends Controller
{
    public function __construct()
    {
        UserHelper::middleware($this);
    }
    public function index(){
        $userSalat = Salat::where('user_id',Auth::id())->OrderBy('created','desc')->get();
        return view('user.salat',compact('userSalat'));
    }

    public function getSingleSalat($salatName){
        $salats = Salat::select('id','user_id',$salatName,'created')->where('user_id',Auth::id())->orderBy('created','desc')->get();
        return view('user.single-salat',compact('salats','salatName'));
    }

    public function salatPerformeChange(Request $request){
        foreach ($request->all() as $key=>$value){
            if($key == "salat-change-id"){
                $salatId = $value;
            }elseif ($key == "salat-change-name"){
                $salatName = $value;
            }elseif ($key == "salat-performe"){
                $salatPerforme = $value;
            }
        }
        $salat = Salat::findOrFail($salatId);
        $salat->$salatName = $salatPerforme;
        $salat->save();
        return $salatName;
    }
    public function salatPerforme(Request $request){
        $salatPerforme = Salat::where('id',$request->salat_id)->first();
        $salat = $request->salat;
        return $salatPerforme->$salat;
    }
    public function salatCount(Request $request){
        $salat = $request->salat;
        $doneZamat = Salat::where('user_id',Auth::id())->where($salat,'dz')->count();
        $doneWithoutZamat = Salat::where('user_id',Auth::id())->where($salat,'dwz')->count();
        $doneKaze = Salat::where('user_id',Auth::id())->where($salat,'dk')->count();
        $doneInTime = Salat::where('user_id',Auth::id())->where($salat,'dt')->count();
        $notDone = Salat::where('user_id',Auth::id())->where($salat,'nd')->count();
        $salatCount = array(
            "dz"  => $doneZamat,
            "dwz" => $doneWithoutZamat,
            "dk" => $doneKaze,
            "dt" => $doneInTime,
            "nd" => $notDone,
            );

        return $salatCount;

    }

    public function overallSalatCount(){
        $fajr = Salat::where('user_id',Auth::id())->where('fajr','nd')->count();
        $zuhr = Salat::where('user_id',Auth::id())->where('zuhr','nd')->count();
        $asr = Salat::where('user_id',Auth::id())->where('asr','nd')->count();
        $maghrib = Salat::where('user_id',Auth::id())->where('maghrib','nd')->count();
        $isha = Salat::where('user_id',Auth::id())->where('isha','nd')->count();
        $witr = Salat::where('user_id',Auth::id())->where('witr','nd')->count();
        $overallSalat = array(
            "fajr" => $fajr,
            "zuhr" => $zuhr,
            "asr" => $asr,
            "maghrib" => $maghrib,
            "isha" => $isha,
            "witr" => $witr,
        );

        return $overallSalat;
    }


}
