<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\Admin\Admin;
use App\Models\User\Hadith;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
