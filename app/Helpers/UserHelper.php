<?php
/**
 * Created by PhpStorm.
 * User: touhe
 * Date: 22-Dec-18
 * Time: 6:57 PM
 */

namespace App\Helpers;


use App\Models\User\Salat;
use Illuminate\Support\Facades\Auth;

class UserHelper
{

    public static function getUser()
    {

        $today = date('y/m/d');
        $salatUser = Salat::where('user_id', Auth::id())->where('created', $today)->first();
        if ($salatUser) {
            return $salatUser;
        } else {
            $salatUser = new Salat();
            $salatUser->user_id = Auth::id();
            $salatUser->created = $today;
            return $salatUser;

        }

    }

    public static function getUserById($id)
    {

        $today = date('y/m/d');
        $salatUser = Salat::where('user_id', $id)->where('created', $today)->first();
        if ($salatUser) {
            return $salatUser;
        } else {
            $salatUser = new Salat();
            $salatUser->user_id = $id;
            $salatUser->created = $today;
            return $salatUser;

        }

    }

    public static function salatPerform($data){
        $returnValue="";
        if($data == NULL){
            $returnValue = "---";
        }elseif($data == "dz"){
            $returnValue = "Done With Zamat";
        }elseif ($data == "dwz"){
            $returnValue = "Done Without Zamat";
        }elseif ($data == "dk"){
            $returnValue = "Done Kaza";
        }elseif ($data == "nd"){
            $returnValue = "Not Done";
        }elseif ($data == "dt"){
            $returnValue = "Done In time";
        }
        return $returnValue;
    }

    public static function middleware($class){
        $class->middleware('preventBackHistory');
        $class->middleware('auth');

    }

}