<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use AsSource;

    protected $fillable = [
        'name',
        'description',
        'teacher_id'
    ];

    public function members()
    {
        return $this->hasMany(GroupMember::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
}
