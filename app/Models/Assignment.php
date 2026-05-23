<?php

namespace App\Models;

use App\Support\MarkdownText;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use AsSource;

    protected $fillable = [
        'lesson_id',
        'description',
        'title'
    ];

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => MarkdownText::normalize($value),
            set: fn (?string $value) => MarkdownText::normalize($value),
        );
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
