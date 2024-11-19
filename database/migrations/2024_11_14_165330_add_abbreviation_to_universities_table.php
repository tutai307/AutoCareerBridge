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
<<<<<<<< HEAD:database/migrations/2024_11_18_094448_add_full_name_to_hirings.php
        Schema::table('hirings', function (Blueprint $table) {
            $table->string('full_name', 255);
========
        Schema::table('universities', function (Blueprint $table) {
            $table->string('abbreviation', 15)->after('name')->unique();
>>>>>>>> c8d6ac91ac69780c21fed76ff0b54b5b9992b938:database/migrations/2024_11_14_165330_add_abbreviation_to_universities_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2024_11_18_094448_add_full_name_to_hirings.php
        Schema::table('hirings', function (Blueprint $table) {
            $table->string('full_name', 255);
========
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn('abbreviation');
>>>>>>>> c8d6ac91ac69780c21fed76ff0b54b5b9992b938:database/migrations/2024_11_14_165330_add_abbreviation_to_universities_table.php
        });
    }
};
