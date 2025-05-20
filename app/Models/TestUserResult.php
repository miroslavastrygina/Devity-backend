<?php

namespace App\Models;

use App\Models\Test;
use App\Models\User;
use Orchid\Screen\AsSource;
use Orchid\Metrics\Chartable;
use Illuminate\Database\Eloquent\Model;

class TestUserResult extends Model
{
    use AsSource, Chartable;

    protected $fillable = [
        'test_id',
        'user_id',
        'avg_points',
        'avg_percent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
