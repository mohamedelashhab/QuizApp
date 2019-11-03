<?php

namespace App\Http\Controllers;

use App\models\Answer;
use App\models\Questation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Request as IlluminateRequest;

class AnswerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, $q_id)
    {
        // return response()->json($request->all(), 200);
        $q = Questation::where('id', '=', $q_id)->first();
        $answer = $q->answers()->create([
            'body' => $request->input('body'),
            'is_correct' => $request->input('is_correct'),
        ]);

        return response()->json($answer, 200);
    }

    public function edit(Request $request, Answer $answer)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $answer->update(
            $request->all()
        );
        return response()->json($answer, 200);
    }

    


}
