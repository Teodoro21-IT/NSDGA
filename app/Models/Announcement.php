<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = [
        'title',
        'announcement_text',
        'urgency_level',
        'registrar_account_id',
    ];

    public function registrar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrar_account_id');
    }

    public function studentAccounts(): BelongsToMany
    {
        return $this->belongsToMany(StudentAccount::class, 'announcement_student_accounts', 'announcement_id', 'student_account_id')
            ->withTimestamps();
    }
}
