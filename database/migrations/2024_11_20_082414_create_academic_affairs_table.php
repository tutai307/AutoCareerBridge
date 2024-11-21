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
        Schema::create('academic_affairs', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->primary('user_id');
            $table->string('name', 255);
            $table->string('phone', 15)->nullable();
            $table->bigInteger('university_id');
            $table->string('avatar_path', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
