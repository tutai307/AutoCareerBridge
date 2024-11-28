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
        Schema::create('university_jobs', function (Blueprint $table) {
            $table->id(); 
            $table->bigInteger('job_id')->unsigned();  
            $table->bigInteger('university_id')->unsigned(); 
            $table->tinyInteger('status')->default(1);  
            $table->timestamps();  


            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_jobs');
    }
};
