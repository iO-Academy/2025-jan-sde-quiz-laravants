<?php

use App\Http\Controllers\QuestionApiController;
use App\Http\Controllers\QuizApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [QuizApiController::class, 'all']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'find']);
Route::post('/questions', [QuestionApiController::class, 'create']);
