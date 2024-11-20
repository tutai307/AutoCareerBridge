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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('abbreviation', 15)->after('name')->unique();
            $table->string('slug', 255)->unique();
            $table->bigInteger('user_id')->unsigned();
            $table->string('avatar_path', 255)->nullable();
            $table->string('map', 255)->nullable();
            $table->text('description')->nullable();
            $table->longText('about')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
