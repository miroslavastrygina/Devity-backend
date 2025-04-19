<?php

namespace App\Models;

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

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}