<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use AsSource;

    protected $fillable = [
        'title',
        'lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function testQuestions()
    {
        return $this->hasMany(TestQuestion::class);
    }
}
