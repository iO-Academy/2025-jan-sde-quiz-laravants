<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScoreRequest;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScoreApiController extends Controller
{
    public function calculate(ScoreRequest $request):JsonResponse
    {
        $score = [
            'question_count' => 0,
            'correct_count' => 0,
            'available_points' => 0,
            'points' => 0
        ];

        $id = $request->quiz;
        $answers = $request->answers;

        $quiz = Quiz::with('questions.answers')->find($id);

        foreach($answers as $answer) {
            $questions = $quiz->questions->find($answer['question']);
            $answer_result = $questions->answers->find($answer['answer']);
            if($answer_result->correct == 1){
                $score['correct_count']++;
                $score['points'] += $questions->points;
            }
        }

        foreach ($quiz->questions as $question) {
            $score['available_points'] += $question->points;
            $score['question_count']++;

        } return response()->json([
            'message' => 'Score calculated',
            'data' => $score,
        ]);

    }
}
