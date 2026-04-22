<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\StudentAccount;

class StudentAcademicHistory extends Model
{
    protected $table = 'student_academic_history';

    protected $fillable = [
        'student_account_id',
        'status',
        'grade_lvl',
        'previous_school_attended',
        'school_year',
    ];

    public function studentAccount(): BelongsTo
    {
        return $this->belongsTo(StudentAccount::class, 'student_account_id');
    }

    public function getGradeLevelAttribute()
    {
        return $this->grade_lvl;
    }

    public function getSchoolNameAttribute()
    {
        return $this->previous_school_attended;
    }

    public function getRemarksAttribute()
    {
        return $this->status;
    }
}