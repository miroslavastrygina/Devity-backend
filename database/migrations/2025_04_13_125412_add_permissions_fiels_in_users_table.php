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
            // $table->string('surname')->nullable()->change();
            // $table->string('patronymic')->nullable()->change();
            // $table->string('phone')->nullable()->change();
            // $table->json('permissions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('surname')->change();
            // $table->string('patronymic')->change();
            // $table->string('phone')->change();
            // $table->dropColumn('permissions');
        });
    }
};
