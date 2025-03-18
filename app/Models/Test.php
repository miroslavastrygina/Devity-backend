<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
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
