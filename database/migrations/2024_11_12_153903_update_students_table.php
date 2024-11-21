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
        Schema::table('students', function (Blueprint $table) {
            $table->tinyInteger('gender')->change();
            $table->date('entry_year')->change();
            $table->date('graduation_year')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('gender')->nullable()->change();
            $table->string('entry_year')->nullable()->change();
            $table->string('graduation_year')->nullable()->change();
        });
    }
};
