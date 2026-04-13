<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use AsSource;

    protected $fillable = [
        'question_id',
        'user_id',
        'user_answer'
    ];

    public function question()
    {
        return $this->belongsTo(TestQuestion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
