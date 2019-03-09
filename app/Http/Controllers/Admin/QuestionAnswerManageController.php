<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Models\User\QuestionAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerManageController extends Controller
{
    public function __construct()
    {
        AdminHelper::constructorWork($this);
    }
    public function index(){
        $questionAnswers = QuestionAnswer::orderBy('created_at','desc')->get();
        return view('admin.question-answer',compact('questionAnswers'));
    }
    public function getById($id){
        return QuestionAnswer::where('id',$id)->first();
    }
    public function get(Request $request){
        return $this->getById($request->questionAnswerId);
    }
    public function delete(Request $request){
        $questionAnswer = $this->getById($request->questionAnswerId);
        $questionAnswer->delete();
        return "true";
    }
    public function manage(Request $request){


        $validator = Validator::make($request->all(), [
            'answer' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,
                'errors' => $validator->errors()->all()]);
        }else {
            $questionAnswer= $this->getById($request->id);
            $questionAnswer->answer = $request->answer;
            $questionAnswer->save();
            return response()->json(['success'=>true]);

        }
    }
}
