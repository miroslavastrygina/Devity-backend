<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'testQuestion.test_id' => 'required|integer',
            'testQuestion.question' => 'required|string',
            'testQuestion.answer' => 'required|string'
        ];
    }
}