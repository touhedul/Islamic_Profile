<?php
namespace App\Helpers;

class AdminHelper{

    public static function constructorWork($class){
        $class->middleware('preventBackHistory');
        $class->middleware('auth:admin');

    }
}

?>