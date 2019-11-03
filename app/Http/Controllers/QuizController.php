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

    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'num' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // return auth()->user();
        $u = User::find($id)->first();

        $quize = $u->quizzes()->create([
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
        return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'num' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $quiz->update([
            $request->all()
        ]);
        return response()->json($quiz, 200);
    }
}
