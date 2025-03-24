<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;


Route::get('/quizzes', [Controllers\QuizApiController::class, 'all']);
