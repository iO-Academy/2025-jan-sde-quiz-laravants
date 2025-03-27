<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\JsonResponse;

class QuestionApiController extends Controller
{
    public function create(QuestionRequest $request): JsonResponse
    {
        $newQuestion = new Question;

        $newQuestion->question = $request->question;
        $newQuestion->hint = $request->hint;
        $newQuestion->points = $request->points;
        $newQuestion->quiz_id = $request->quiz_id;
        $newQuestion->save();

        if (! $newQuestion->save()) {
            return response()->json(['Question creation failed'], 500);
        }

        return response()->json([
            'message' => 'Question added'], 201);
    }

    public function delete(Question $question): JsonResponse
    {
        $question->delete();

        return response()->json(['message' => 'Question deleted']);
    }

    public function update(QuestionRequest $request, Question $question): JsonResponse
    {
        $question->question = $request->question;
        $question->points = $request->points;
        $question->hint = $request->hint;

        $question->save();

        if (! $question->save()) {
            return response()->json([
                'message' => 'Question editing failed',
            ], 500);
        }

        return response()->json([
            'message' => 'Question edited',
        ], 201);
    }
}
