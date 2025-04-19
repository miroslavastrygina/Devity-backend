<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class AssignmentGrade extends Model
{
    use AsSource;

    protected $fillable = [
        'submission_id',
        'teacher_id',
        'score',
        'feedback'
    ];

    public function submission()
    {
        return $this->belongsTo(AssignmentSubmission::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
}