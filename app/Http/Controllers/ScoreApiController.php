<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScoreApiController extends Controller
{
    public function calculate(Request $request):JsonResponse
    {
//        $request->validate([
//            'quiz_id' => 'required|integer',
//            'answers' => 'required|array',
//            'answers.*.question_id' => 'required|integer'
//        ]);

        $score = [
            'question_count' => 0,
            'correct_count' => 0,
            'available_points' => 0,
            'points' => 0
        ];

        $id = $request->quiz;
        $answers = $request->answers;

        $quiz = Quiz::with('questions.answers')->find($id);

//        $answer_id = $request->answers->answer;



        foreach($answers as $answer) {
            $questions = $quiz->questions->find($answer['question']);
            $answer_result = $questions->answers->find($answer['answer']);
            if($answer_result->correct == 1){
                $score['correct_count']++;
            }
        }



        // Clue
//        $question = $quiz->questions->find(2);
//        $question->answers->find(3);

//        foreach($answers as $answer){
//            if($->correct == 1) {
//                $score['correct_count']++;
//            }
//        }

        //id of the answer


        foreach ($quiz->questions as $question) {
            $score['available_points'] += $question->points;
            $score['question_count']++;

        } return response()->json([
            'message' => 'Score calculated',
            'data' => $score,
        ]);

    }
}
