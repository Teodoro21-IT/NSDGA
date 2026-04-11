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
        Schema::create('student_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_enrollment_form_id')
                ->constrained('student_enrollment_forms')
                ->cascadeOnDelete();
            $table->string('document_type');
            $table->enum('document_status', [
                'verified',
                'under_review',
                'not_uploaded',
                'action_needed',
            ]);
            $table->string('document_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_documents');
    }
};
