<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'question' => 'required|string|max:70',
            'hint' => 'nullable|string|max:70',
            'points' => 'required|integer',
            'quiz_id' => 'exists:quizzes,id|required|integer',
        ];
    }
}
