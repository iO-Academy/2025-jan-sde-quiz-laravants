<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class ScoreApiController extends Controller
{
    public function calculate(Request $request): int
    {
//        $request->validate([
//            'quiz_id' => 'required|integer',
//            'answers' => 'required|array',
//            'answers.*.question_id' => 'required|integer'
//        ]);

        $question_count = 0;
        $correct_count = 0;
        $available_points = 0;
        $points = 0;

        $id = $request->quiz_id;
        $answers = $request->answers;

        $quiz = Quiz::with('questions.answers')->find($id);

        foreach ($answers as $answer) {
            $question_count++;
            $questions = $quiz->questions = $request->questions;
        } foreach ($questions as $question) {
            $available_points += $question->points;
        } return $available_points;
    }
}
