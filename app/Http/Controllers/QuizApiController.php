<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizRequest;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;

class QuizApiController extends Controller
{
    public function all(): JsonResponse
    {
        $quizzes = Quiz::all()->makehidden(['updated_at', 'created_at']);

        return response()->json([
            'message' => 'Quizzes retrieved!',
            'data' => $quizzes,
        ]);
    }

    public function find(int $id): JsonResponse
    {
        $quiz = Quiz::with('questions.answers')->find($id);

        if (! $quiz) {
            return response()->json([
                'message' => 'Quiz not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Quiz retrieved',
            'data' => $quiz,
        ]);
    }


    public function create(CreateQuizRequest $request): JsonResponse
    {
        $quiz = new Quiz;
        $quiz->name = $request->name;
        $quiz->description = $request->description;
        $quiz->save();

        if (! $quiz->save()) {
            return response()->json([
                'message' => 'Quiz creation failed',
            ], 500);
        }

        return response()->json([
            'message' => 'Quiz created',
        ], 201);
    }

    public function update(CreateQuizRequest $request, Quiz $quiz): JsonResponse
    {
        $quiz->name = $request->name;
        $quiz->description = $request->description;

        $quiz->save();

        if (!$quiz->save()) {
            return response()->json([
                'message' => 'Quiz editing failed',
            ], 500);
        }

        return response()->json([
            'message' => 'Quiz created'
        ], 201);
    }
}
