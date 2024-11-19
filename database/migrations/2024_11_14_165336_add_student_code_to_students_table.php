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
<<<<<<<< HEAD:database/migrations/2024_11_18_203138_add_avatar_path_to_hirings.php
        Schema::table('hirings', function (Blueprint $table) {
            $table->string('avatar_path')->nullable();
========
        Schema::table('students', function (Blueprint $table) {
            $table->string('student_code', 15)->after('name')->unique();
>>>>>>>> c8d6ac91ac69780c21fed76ff0b54b5b9992b938:database/migrations/2024_11_14_165336_add_student_code_to_students_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2024_11_18_203138_add_avatar_path_to_hirings.php
        Schema::table('hirings', function (Blueprint $table) {
            $table->dropColumn('avatar_path');
========
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('student_code');
>>>>>>>> c8d6ac91ac69780c21fed76ff0b54b5b9992b938:database/migrations/2024_11_14_165336_add_student_code_to_students_table.php
        });
    }
};
