<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/quizzes', [Controllers\QuizApiController::class, 'all']);
