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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 255);
            $table->string('slug' , 255);
            $table->bigInteger('user_id' );
            $table->string('avatar_path' , 255)->nullable();
            $table->text('map')->nullable();
            $table->string('phone', 10);
            $table->string('size' , 255)->nullable();
            $table->text('description')->nullable();
            $table->longText('about')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
