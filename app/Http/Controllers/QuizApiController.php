<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizApiController extends Controller
{
    public function find(int $id): JsonResponse
    {
        $quiz = Quiz::with('question')->find($id)->makeHidden(['quiz_id', 'created_at', 'updated_at']);


        return response() ->json([
            'message' => 'Quiz retrieved',
            'data' => $quiz,
        ]);
    }
}
