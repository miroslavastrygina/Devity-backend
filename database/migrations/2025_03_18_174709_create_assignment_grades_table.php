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
        Schema::create('assignment_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('assignment_submissions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('score');
            $table->text('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_grades');
    }
};
