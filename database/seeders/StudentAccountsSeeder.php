<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentAccountsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_accounts')->updateOrInsert(
            ['email' => 'student@gmail.com'],
            [
                'full_name' => 'student user',
                'lrn' => '123456789012',
                'education_level' => 'senior_high',
                'password' => Hash::make('studentpass'),
                'otp_code' => null,
                'otp_expires_at' => null,
                'is_locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('student_accounts')->updateOrInsert(
            ['email' => 'KUPAK@gmail.com'],
            [
                'full_name' => 'student2 user',
                'lrn' => '123456789011',
                'education_level' => 'senior_high',
                'password' => Hash::make('student2pass'),
                'otp_code' => null,
                'otp_expires_at' => null,
                'is_locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
