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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('university_id')->unsigned();
            $table->bigInteger('major_id')->unsigned();
            $table->string('name');
            $table->string('student_code', 15)->unique();
            $table->string('slug');
            $table->string('avatar_path')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('gender');
            $table->string('entry_year')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
