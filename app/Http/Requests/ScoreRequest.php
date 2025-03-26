<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'quiz' => 'required|integer',
            'answers' => 'required|array',
            'answers.*.question' => 'required|string|exists:questions,id',
            'answer.*.answer' => 'required|integer|exists:answers,id'
        ];
    }
}
