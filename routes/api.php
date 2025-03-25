<?php

use App\Http\Controllers\QuizApiController;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [QuizApiController::class, 'all']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'find']);
Route::post('/quizzes', [QuizApiController::class, 'create']);
