<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QuizApiController extends Controller
{
    public function all(){
        $quizzes = Quiz::all()->makehidden(['updated_at', 'created_at']);
        $outcome = response() -> json([
            'message' => 'Quizzes retrieved!',
            'data' => $quizzes,
        ]);
        if ($outcome == null){
            return "Failed to retrieve quizzes...";
        } else {
            return $outcome;
        }
    }
}
