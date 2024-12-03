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
        Schema::create('company_workshops', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('workshop_id')->unsigned();
            $table->tinyInteger('status')->default(1);
            $table->primary(['company_id', 'workshop_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_workshops');
    }
};
