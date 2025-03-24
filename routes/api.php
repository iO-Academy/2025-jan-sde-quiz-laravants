<?php

use App\Http\Controllers\QuizApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes/{id}',[QuizApiController::class, 'find']);
