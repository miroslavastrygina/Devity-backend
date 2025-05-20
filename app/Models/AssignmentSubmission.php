<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use AsSource;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'file_url',
        'submitted_at',
        'rated'
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->hasOne(AssignmentGrade::class);
    }
}
