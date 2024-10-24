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
        Schema::table('condition_value_objects', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('execution_status_id')->references('id')->on('execution_statuses');
            $table->foreign('task_priority_id')->references('id')->on('task_priorities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_value_objects', function (Blueprint $table) {
            $table->dropForeign(['category_id', 'execution_status_id', 'task_priority_id']);
        });
    }
};
