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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
<<<<<<<< HEAD:database/migrations/2024_11_12_222217_add_soft_deletes_to_users_table.php
            $table->dropSoftDeletes();
========
            //
>>>>>>>> c8d6ac91ac69780c21fed76ff0b54b5b9992b938:database/migrations/2024_11_12_143119_add_deleted_at_column_to_users_table.php
        });
    }
};
