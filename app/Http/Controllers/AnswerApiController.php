<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\JsonResponse;

class AnswerApiController extends Controller
{
    public function create(CreateAnswerRequest $request): JsonResponse
    {
        $answer = new Answer;
        $answer->answer = $request->answer;
        $answer->correct = $request->correct;
        $answer->question_id = $request->question_id;

        $answer->save();

        if (! $answer->save()) {
            return response() - json([
                'message' => 'Answer creation failed',
            ], 500);
        }

        return response()->json([
            'message' => 'Answer created',
        ], 201);
    }
}
