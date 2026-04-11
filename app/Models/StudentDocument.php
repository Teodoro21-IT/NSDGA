<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDocument extends Model
{
    protected $table = 'student_documents';

    protected $fillable = [
        'student_enrollment_form_id',
        'document_type',
        'document_status',
        'document_path',
    ];

    public function enrollmentForm(): BelongsTo
    {
        return $this->belongsTo(StudentEnrollmentForm::class, 'student_enrollment_form_id');
    }
}