<?php

namespace App\Http\Controllers;

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
}
