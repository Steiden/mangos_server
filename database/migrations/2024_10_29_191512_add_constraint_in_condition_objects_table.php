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
        Schema::table('condition_objects', function (Blueprint $table) {
            $table->dropForeign('condition_objects_task_id_foreign');
            $table->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_objects', function (Blueprint $table) {
            $table->dropForeign('condition_objects_task_id_foreign');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }
};
