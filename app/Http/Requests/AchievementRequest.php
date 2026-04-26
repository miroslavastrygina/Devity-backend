<?php

namespace App\Http\Requests;

use App\Models\Achievement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AchievementRequest extends FormRequest
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
            'achievement.title' => 'required|string|max:255',
            'achievement.slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('achievements', 'slug')->ignore($this->route('id')),
            ],
            'achievement.description' => 'nullable|string',
            'achievement.icon' => 'nullable|string|max:255',
            'achievement.action_type' => ['required', Rule::in(array_keys(Achievement::actionOptions()))],
            'achievement.condition_value' => 'required|integer|min:1',
            'achievement.points' => 'nullable|integer|min:0',
            'achievement.is_active' => 'nullable|boolean',
        ];
    }
}
