<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $newQuestion = new Question();
        $request->validate([
            'question' => 'string',
            'hint' => 'nullable|string',
            'points' => 'integer',
            'quiz_id' => 'integer'
        ]);
        $newQuestion->question = $request->question;
        $newQuestion->hint = $request->hint;
        $newQuestion->points = $request->points;
        $newQuestion->quiz_id = $request->quiz_id;


        $newQuestion->save();
        if (!$newQuestion->save()) {
            return response()->json(["Question creation failed"], 500);
        } else {
            return response()->json([
                'message' => 'Question added'
            ]);
        }
    }
}
