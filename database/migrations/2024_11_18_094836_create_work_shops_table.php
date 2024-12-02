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
        Schema::create('work_shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->bigInteger('university_id')->unsigned();
            $table->string('avatar_path')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('amount')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_shops');
    }
};
