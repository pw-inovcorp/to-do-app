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
        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->index('user_id');

            $table->index(['user_id', 'completed']);

            $table->index(['user_id', 'priority']);

            $table->index(['user_id', 'due_date']);

            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->dropIndex(['user_id', 'created_at']);
            $table->dropIndex(['user_id', 'due_date']);
            $table->dropIndex(['user_id', 'priority']);
            $table->dropIndex(['user_id', 'completed']);
            $table->dropIndex(['user_id']);
        });
    }
};
