<?php

namespace App\Http\Controllers;

use App\models\Quiz;
use Illuminate\Http\Request;

class QuestationController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, $q_id)
    {
        $quizz = Quiz::find($q_id)->first();

        $quizz->questations()->create([
            'body' => $request->input('body'),
            'is_correct' => $request->input('is_correct')
        ]);

        return response()->json($request->all(), 200);

    }
}
