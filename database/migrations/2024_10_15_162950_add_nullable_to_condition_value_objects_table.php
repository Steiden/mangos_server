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
            $table->string('attribute_name')->nullable()->change();
            $table->string('value')->nullable()->change();
            $table->unsignedBigInteger('task_tag_id')->nullable()->change();
            $table->unsignedBigInteger('category_id')->nullable()->change();
            $table->unsignedBigInteger('execution_status_id')->nullable()->change();
            $table->unsignedBigInteger('task_priority_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_value_objects', function (Blueprint $table) {
            //
        });
    }
};
