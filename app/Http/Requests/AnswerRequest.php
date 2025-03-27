<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'answer' => 'required|string|min:1',
            'correct' => 'required|boolean',
        ];

        if ($this->method() === 'POST') {
            $rules['question_id'] = 'required|integer|exists:questions,id';
        }

        return $rules;
    }
}
