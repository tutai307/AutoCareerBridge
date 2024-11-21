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
        Schema::table('academic_affairs', function (Blueprint $table) {
            $table->string('full_name', 255);
            $table->string('phone', 15)->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('university_id')->unsigned();
            $table->string('avatar_path', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_affairs');
    }
};
