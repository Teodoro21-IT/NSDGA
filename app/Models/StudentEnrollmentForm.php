<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentEnrollmentForm extends Model
{
    protected $table = 'student_enrollment_forms';

    protected $fillable = [
        'student_account_id',
        'first_name',
        'middle_name',
        'last_name',
        'lrn',
        'sex',
        'age',
        'date_of_birth',
        'birthplace',
        'nationality',
        'home_address',
        'contact_number',
        'education_level',
        'grade_level_applying_for',
        'school_year',
        'student_type',
        'previous_school_attended',
        'course_strand_interested',
        'last_grade_year_level_completed',
        'gwa',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'age' => 'integer',
        'gwa' => 'decimal:2',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(StudentDocument::class);
    }

    public function studentAccount(): BelongsTo
    {
        return $this->belongsTo(StudentAccount::class);
    }
}