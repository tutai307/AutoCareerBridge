<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn(['scale', 'training_program']);
        });
    }

    public function down()
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->string('scale')->nullable();
            $table->text('training_program')->nullable();
        });
    }
};

