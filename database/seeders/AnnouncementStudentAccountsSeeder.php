<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementStudentAccountsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = DB::table('student_accounts')
            ->where('email', 'student@gmail.com')
            ->first();

        if (!$student) {
            return;
        }

        $announcementIds = DB::table('announcements')
            ->whereIn('title', [
                'Urgent Enrollment Notice',
                'Required Documents Reminder',
                'General Enrollment Update',
            ])
            ->pluck('id');

        if ($announcementIds->isEmpty()) {
            return;
        }

        $now = now();

        foreach ($announcementIds as $announcementId) {
            DB::table('announcement_student_accounts')->updateOrInsert(
                [
                    'announcement_id' => $announcementId,
                    'student_account_id' => $student->id,
                ],
                [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
