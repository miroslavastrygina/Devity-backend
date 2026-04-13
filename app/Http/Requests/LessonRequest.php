<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            "lesson.title" => "required|string|min:5",
            "lesson.content" => "required|string|min:5",
            "lesson.block_id" => "required|integer",
            "lesson.video_url" => "nullable|string|min:5",
        ];
    }
}
