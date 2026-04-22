<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_academic_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_account_id')
                ->constrained('student_accounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->string('grade_lvl')->nullable();
            $table->string('previous_school_attended')->nullable();
            $table->string('school_year')->nullable();
            $table->timestamps();
        });

        // Seed academic history from existing enrollment forms.
        $enrollments = DB::table('student_enrollment_forms')
            ->where('student_type', 'enrolled')
            ->get();

        foreach ($enrollments as $enrollment) {
            DB::table('student_academic_history')->insert([
                'student_account_id' => $enrollment->student_account_id,
                'status' => 'current',
                'grade_lvl' => $enrollment->grade_level_applying_for,
                'previous_school_attended' => $enrollment->previous_school_attended,
                'school_year' => $enrollment->school_year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_academic_history');
    }
};
