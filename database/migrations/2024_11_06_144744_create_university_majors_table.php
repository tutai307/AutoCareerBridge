<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('university_majors', function (Blueprint $table) {
            $table->bigInteger('university_id')->unsigned();
            $table->bigInteger('major_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['university_id', 'major_id']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_majors');
    }
};
