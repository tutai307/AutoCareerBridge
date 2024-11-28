<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('collaborations', function (Blueprint $table) {
            $table->string('title', 255)->nullable()->after('company_id');
            $table->string('response_message', 255)->nullable()->after('status');
            $table->date('start_date')->nullable()->after('content');  // Đặt là nullable
            $table->date('end_date')->nullable()->change();
            $table->tinyInteger('status')->default(1)->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collaborations', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('response_message');
            $table->dropColumn('start_date');
            $table->date('end_date')->change();
            $table->integer('status')->default(1)->change();
        });
    }
};
