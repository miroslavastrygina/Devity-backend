<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $lesson = $this->input('lesson', []);

        if (isset($lesson['compiler_blocks_json'])) {
            $raw = trim((string) $lesson['compiler_blocks_json']);
            if ($raw === '') {
                $lesson['compiler_blocks'] = [];
            } else {
                $decoded = json_decode($raw, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw ValidationException::withMessages([
                        'lesson.compiler_blocks_json' => 'Некорректный JSON: '.json_last_error_msg(),
                    ]);
                }
                if (! is_array($decoded)) {
                    throw ValidationException::withMessages([
                        'lesson.compiler_blocks_json' => 'JSON должен быть массивом объектов.',
                    ]);
                }
                $lesson['compiler_blocks'] = $decoded;
            }
            unset($lesson['compiler_blocks_json']);
        } elseif (! isset($lesson['compiler_blocks'])) {
            $lesson['compiler_blocks'] = [];
        }

        $this->merge(['lesson' => $lesson]);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lesson.title' => 'required|string|min:5',
            'lesson.content' => 'required|string|min:5',
            'lesson.block_id' => 'required|integer',
            'lesson.video_url' => 'nullable|string|max:2048',
            'lesson.compiler_blocks' => 'nullable|array|max:20',
            'lesson.compiler_blocks.*.code' => 'required|string|max:100000',
        ];
    }
}
