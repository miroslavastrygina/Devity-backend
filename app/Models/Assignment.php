<?php

namespace App\Models;

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

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
