<?php

use App\Http\Controllers\AnswerApiController;
use App\Http\Controllers\QuestionApiController;
use App\Http\Controllers\QuizApiController;
use App\Http\Controllers\ScoreApiController;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [QuizApiController::class, 'all']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'find']);
Route::put('/quizzes/{quiz}', [QuizApiController::class, 'update'])->missing(function () {
    return response()->json([
        'message' => 'Quiz not found',
    ], 404);
});
Route::put('/questions/{question}', [QuestionApiController::class, 'update'])->missing(function () {
    return response()->json([
        'message' => 'Question not found',
    ], 404);
});
Route::post('/questions', [QuestionApiController::class, 'create']);
Route::post('/quizzes', [QuizApiController::class, 'create']);
Route::post('/answers', [AnswerApiController::class, 'create']);
Route::put('/answers/{answer}', [AnswerApiController::class, 'update'])->missing(function () {
    return response()->json([
        'message' => 'Answer not found',
    ], 404);
});
Route::delete('/questions/{question}', [QuestionApiController::class, 'delete'])->missing(function () {
    return response()->json([
        'message' => 'Question not found',
    ], 404);
});
Route::delete('/answers/{answer}', [AnswerApiController::class, 'delete'])->missing(function () {
    return response()->json([
        'message' => 'Answer not found',
    ], 404);
});
Route::post('/scores', [ScoreApiController::class, 'calculate']);
