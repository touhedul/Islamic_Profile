<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalatCreationController extends Controller
{
    public function __construct()
    {
        UserHelper::middleware($this);
    }

    public function createFajr(Request $request){
        $fajr = $request->data;
        $salat = UserHelper::getUser();
        $salat->fajr = $fajr;
        $salat->save();
    }
    public function createZuhr(Request $request){
        $zuhr = $request->data;
        $salat = UserHelper::getUser();
        $salat->zuhr = $zuhr;
        $salat->save();
    }
    public function createAsr(Request $request){
        $asr = $request->data;
        $salat = UserHelper::getUser();
        $salat->asr = $asr;
        $salat->save();
    }
    public function createMaghrib(Request $request){
        $maghrib = $request->data;
        $salat = UserHelper::getUser();
        $salat->maghrib = $maghrib;
        $salat->save();
    }
    public function createIsha(Request $request){
        $isha = $request->data;
        $salat = UserHelper::getUser();
        $salat->isha = $isha;
        $salat->save();
    }
    public function createWitr(Request $request){
        $witr = $request->data;
        $salat = UserHelper::getUser();
        $salat->witr = $witr;
        $salat->save();
    }
}
