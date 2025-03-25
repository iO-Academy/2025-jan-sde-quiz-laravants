<?php

use App\Http\Controllers\AnswerApiController;
use App\Http\Controllers\QuizApiController;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [QuizApiController::class, 'all']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'find']);
Route::put('/quizzes/{id}', [QuizApiController::class, 'update']);
Route::post('/quizzes', [QuizApiController::class, 'create']);
Route::post('/answers', [AnswerApiController::class, 'create']);
