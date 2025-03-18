<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentGrade extends Model
{
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
