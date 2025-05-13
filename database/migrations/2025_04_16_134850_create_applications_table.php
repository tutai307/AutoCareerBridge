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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // ID sinh viên
            $table->unsignedBigInteger('job_id'); // ID công việc
            $table->unsignedBigInteger('resume_id'); // ID CV được chọn để ứng tuyển
            $table->text('cover_letter')->nullable(); // Thư giới thiệu
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Trạng thái ứng tuyển
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
