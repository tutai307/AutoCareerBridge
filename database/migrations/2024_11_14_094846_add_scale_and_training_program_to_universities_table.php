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
        Schema::table('universities', function (Blueprint $table) {
            $table->integer('scale')->nullable()->after('deleted_at'); // Thêm cột 'Quy mô'
            $table->integer('training_program')->nullable()->after('scale'); // Thêm cột 'Chương trình đào tạo'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
                $table->dropColumn(['scale', 'training_program']);
        });
    }
};
