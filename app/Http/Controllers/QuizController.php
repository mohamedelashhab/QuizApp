<?php

namespace App\Http\Controllers;

use App\models\Quiz;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request,User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'num' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // return auth()->user();

        $quize = $user->quizzes()->create([
            'name' => $request->input('name'),
            'num' => $request->input('num'),
        ]);

        return response()->json($quize, 200);
    }

    public function show($id)
    {
        $res = Quiz::where('id', '=', $id)->with(['questations.answers'])->first();
        return response()->json($res, 200);
    }

    public function edit(Request $request, Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'num' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $quiz->update(
            $request->all()
        );
        return response()->json($quiz, 200);
    }

    public function publish(Request $request, Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [
            'published' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $quiz->published = 1;
        $quiz->save();
        return response()->json($quiz, 200);

    }

    public function list(Request $request)
    {
        if($request->has('teacher_id') && $request->input('teacher_id') > 0){
            $quizzes = Quiz::where('teacher_id', '=', $request->input('teacher_id'))->get();
            return response()->json($quizzes, 200);
        }
        if($request->has('teacher_id') && $request->input('teacher_id') == 0){
            $quizzes = Quiz::where('published', '=', true)->get();
            return response()->json($quizzes, 200);
        }
        if($request->has('published')){
            $quizzes = Quiz::where('published', '=', $request->input('published'))->get();
            return response()->json($quizzes, 200);
        }
        else{
            $quizzes = Quiz::all();
            return response()->json($quizzes, 200);
        }
        

    }
}
