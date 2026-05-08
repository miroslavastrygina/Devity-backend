<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Achievement extends Model
{
    use AsSource;

    public const ACTION_TEST_PASSED = 'test_passed';
    public const ACTION_ASSIGNMENT_SUBMITTED = 'assignment_submitted';
    public const ACTION_ASSIGNMENT_GRADED = 'assignment_graded';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'action_type',
        'condition_value',
        'points',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withPivot('awarded_at')
            ->withTimestamps();
    }

    public static function actionOptions(): array
    {
        return [
            self::ACTION_TEST_PASSED => 'Успешные тесты (>= 70%)',
            self::ACTION_ASSIGNMENT_SUBMITTED => 'Сданные практические задания',
            self::ACTION_ASSIGNMENT_GRADED => 'Проверенные задания',
        ];
    }
}
