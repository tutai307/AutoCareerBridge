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
        Schema::table('majors', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->bigInteger('field_id')->nullable()->after('name');
            $table->tinyInteger('status')->default(1)->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('field_id');
            $table->dropColumn('status');
        });
    }
};
