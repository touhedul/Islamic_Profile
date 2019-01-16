<?php

namespace App\Http\Controllers\User;

use App\Helpers\UserHelper;
use App\Models\User\Hadith;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HadithController extends Controller
{
    public function __construct()
    {
        UserHelper::middleware($this);
    }

    public function hadithIndex()
    {
        $hadiths = Hadith::where('status',1)->paginate(3);
        return view('user.hadith',compact('hadiths'));
    }

    public function hadithPost(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'source' => 'required | max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        } else {
            if ($request->ajax()) {
                $description = "";
                $source = "";
                foreach ($request->all() as $key=>$value){
                    if($key == "description"){
                        $description = $value;
                    }
                    if($key == "source"){
                        $source = $value;
                    }
                }
                $hadith = new Hadith();
                $hadith->user_id = Auth::id();
                $hadith->description = $description;
                $hadith->source = $source;
                $hadith->save();

                return response()->json(['success'=>true]);
            }
        }
    }
}
