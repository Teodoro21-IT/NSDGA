<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrar = User::where('role', 'registrar')->first();

        if (!$registrar) {
            return;
        }

        $now = now();

        DB::table('announcements')->updateOrInsert(
            ['title' => 'Urgent Enrollment Notice'],
            [
                'announcement_text' => 'Please complete your enrollment requirements today.',
                'urgency_level' => 'urgent',
                'registrar_account_id' => $registrar->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('announcements')->updateOrInsert(
            ['title' => 'Required Documents Reminder'],
            [
                'announcement_text' => 'Submit all required documents by the deadline.',
                'urgency_level' => 'required',
                'registrar_account_id' => $registrar->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        DB::table('announcements')->updateOrInsert(
            ['title' => 'General Enrollment Update'],
            [
                'announcement_text' => 'Enrollment schedule is posted on the bulletin.',
                'urgency_level' => 'informational',
                'registrar_account_id' => $registrar->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }
}
