<?php

namespace App\Http\Controllers;

use App\models\Questation;
use Illuminate\Http\Request;
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

        $q = Questation::find($q_id)->first();
        $q->answers()->create([
            'body' => $request->input('body'),
            'is_correct' => $request->input('is_correct'),
        ]);

        return response()->json($request->all(), 200);
    }

    


}
