<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assignment_submissions', function (Blueprint $table) {
            $table->index(['rated', 'user_id'], 'idx_assignment_submissions_rated_user');
            $table->index(['assignment_id', 'user_id'], 'idx_assignment_submissions_assignment_user');
        });

        Schema::table('test_user_results', function (Blueprint $table) {
            $table->index(['user_id', 'avg_percent'], 'idx_test_user_results_user_percent');
            $table->index(['test_id', 'created_at'], 'idx_test_user_results_test_created');
        });
    }

    public function down(): void
    {
        try {
            Schema::table('assignment_submissions', function (Blueprint $table) {
                $table->dropIndex('idx_assignment_submissions_rated_user');
            });
        } catch (\Throwable) {
            // Ignore rollback index issues when MySQL keeps index for FK support.
        }

        try {
            Schema::table('assignment_submissions', function (Blueprint $table) {
                $table->dropIndex('idx_assignment_submissions_assignment_user');
            });
        } catch (\Throwable) {
            // Ignore rollback index issues when MySQL keeps index for FK support.
        }

        try {
            Schema::table('test_user_results', function (Blueprint $table) {
                $table->dropIndex('idx_test_user_results_user_percent');
            });
        } catch (\Throwable) {
            // Ignore rollback index issues when MySQL keeps index for FK support.
        }

        try {
            Schema::table('test_user_results', function (Blueprint $table) {
                $table->dropIndex('idx_test_user_results_test_created');
            });
        } catch (\Throwable) {
            // Ignore rollback index issues when MySQL keeps index for FK support.
        }
    }
};
