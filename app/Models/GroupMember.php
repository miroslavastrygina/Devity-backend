<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use AsSource;

    protected $fillable = [
        'group_id',
        'user_id',
        'joined_at'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
