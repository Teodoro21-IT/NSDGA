<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentAccount extends Model
{
    protected $table = 'student_accounts';

    protected $fillable = [
        'full_name',
        'email',
        'lrn',
        'education_level',
        'password',
        'otp_code',
        'otp_expires_at',
        'is_locked',
    ];

    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'otp_expires_at' => 'datetime',
        'is_locked' => 'boolean',
    ];

    public function enrollmentForm(): HasOne
    {
        return $this->hasOne(StudentEnrollmentForm::class);
    }
}
