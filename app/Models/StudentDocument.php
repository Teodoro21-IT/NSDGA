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

    /**
     * Rename this function to studentEnrollmentForm to match your RegistrarController
     */
    public function studentEnrollmentForm(): BelongsTo
    {
        return $this->belongsTo(StudentEnrollmentForm::class, 'student_enrollment_form_id');
    }
}