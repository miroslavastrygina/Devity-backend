<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'content',
        'block_id',
        'video_url'
    ];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function assignments()
    {
        return $this->hasOne(Assignment::class);
    }

    public function tests()
    {
        return $this->hasOne(Test::class);
    }
}
