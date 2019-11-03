<?php

namespace App\Http\Controllers;

use App\models\Questation;
use App\models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as IlluminateRequest;

class QuestationController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, $q_id)
    {
        
        $quizz = Quiz::where('id' , '=' ,$q_id)->first();
        $questation = $quizz->questations()->create([
            'body' => $request->input('body'),
        ]);

        
        return response()->json($questation, 200);

    }

    public function edit(Request $request, Questation $questation)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
            'quiz_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $questation->update([
            $request->all()
        ]);
        return response()->json($questation, 200);
    }
}
