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
        Schema::create('company_majors', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('major_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['company_id', 'major_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_majors');
    }
};
