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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('company_id')->nullable();
            $table->BigInteger('university_id')->nullable();
            $table->string('title', 255)->nullable();
            $table->tinyInteger('type')->nullable();
            $table->text('link')->nullable();
            $table->tinyInteger('is_seen')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
