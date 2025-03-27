<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use Illuminate\Http\JsonResponse;

class AnswerApiController extends Controller
{
    public function create(AnswerRequest $request): JsonResponse
    {
        $answer = new Answer;
        $answer->answer = $request->answer;
        $answer->correct = $request->correct;
        $answer->question_id = $request->question_id;

        $answer->save();

        if (! $answer->save()) {
            return response()->json([
                'message' => 'Answer creation failed',
            ], 500);
        }

        return response()->json([
            'message' => 'Answer created',
        ], 201);
    }

    public function delete(Answer $answer): JsonResponse
    {
        $answer->delete();

        return response()->json(['message' => 'Answer deleted']);
    }

    public function update(AnswerRequest $request, Answer $answer): JsonResponse
    {

        $answer->answer = $request->answer;
        $answer->correct = $request->correct;

        $answer->save();

        if (! $answer->save()) {
            return response()->json([
                'message' => 'Answer editing failed',
            ], 500);
        }

        return response()->json([
            'message' => 'Answer edited',
        ]);
    }
}
