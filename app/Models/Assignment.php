<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'lesson_id',
        'description'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
