<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [Controllers\QuizApiController::class, 'all']);
Route::get('/quizzes/{id}', [QuizApiController::class, 'find']);
