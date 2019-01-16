<?php

namespace App\Http\Controllers\User;


use App\Helpers\UserHelper;
use App\Models\User\QuestionAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerController extends Controller
{
    public function __construct()
    {
        UserHelper::middleware($this);
    }

    public function QAIndex()
    {
        $QAs = QuestionAnswer::where('status', 1)->paginate(3);
        return view('user.question-answer', compact('QAs'));
    }

    public function QuestionAsk(Request $request)
    {
        //return response()->json(['success'=>true]);

        $validator = Validator::make($request->all(), [
            'question' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        } else {
            if ($request->ajax()) {
                $question = "";
                foreach ($request->all() as $key=>$value){
                    if($key == "question"){
                        $question = $value;
                    }
                }
                $qa = new QuestionAnswer();
                $qa->user_id = Auth::id();
                $qa->question = $question;
                $qa->save();
                return response()->json(['success' => true]);
            }
        }
    }
}
