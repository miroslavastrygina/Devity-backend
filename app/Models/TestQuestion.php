<?php

namespace App\Models;

use App\Support\MarkdownText;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use AsSource;

    protected $fillable = [
        'test_id',
        'question',
        'answer'
    ];

    protected function question(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => MarkdownText::normalize($value),
            set: fn (?string $value) => MarkdownText::normalize($value),
        );
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function results()
    {
        return $this->hasMany(TestResult::class, 'question_id');
    }
}
