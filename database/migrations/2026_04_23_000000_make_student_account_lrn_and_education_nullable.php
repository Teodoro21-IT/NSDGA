<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `student_accounts` MODIFY COLUMN `lrn` CHAR(12) NULL;");
        DB::statement("ALTER TABLE `student_accounts` MODIFY COLUMN `education_level` ENUM('preschool','grade_school','junior_high','senior_high') NULL;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `student_accounts` MODIFY COLUMN `lrn` CHAR(12) NOT NULL;");
        DB::statement("ALTER TABLE `student_accounts` MODIFY COLUMN `education_level` ENUM('preschool','grade_school','junior_high','senior_high') NOT NULL;");
    }
};
