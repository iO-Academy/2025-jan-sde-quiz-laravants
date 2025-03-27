<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function rules(): array
    {

        $rules = [
            'question' => 'required|string|max:70',
            'hint' => 'nullable|string|max:70',
            'points' => 'required|integer'
        ];

        if ($this->method() === 'POST'){
            $rules['quiz_id'] = 'exists:quizzes,id|required|integer';
        }

        return $rules;
    }
}
