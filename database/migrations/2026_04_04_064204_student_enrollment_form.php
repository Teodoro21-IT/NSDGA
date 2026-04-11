<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_enrollment_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_account_id')->unique()->constrained('student_accounts')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('lrn', 12)->unique();
            $table->string('sex', 20);
            $table->unsignedTinyInteger('age');
            $table->date('date_of_birth');
            $table->string('birthplace');
            $table->text('home_address');
            $table->string('contact_number', 20);
            $table->string('education_level');
            $table->string('grade_level_applying_for');
            $table->string('school_year', 20);
            $table->string('student_type');
            $table->string('previous_school_attended')->nullable();
            $table->string('course_strand_interested')->nullable();
            $table->string('last_grade_year_level_completed');
            $table->decimal('gwa', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollment_forms');
    }
};
