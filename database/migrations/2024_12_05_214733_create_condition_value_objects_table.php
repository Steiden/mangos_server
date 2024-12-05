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
        Schema::create('condition_value_objects', function (Blueprint $table) {
            $table->id();
            $table->string('attribute_name')->nullable();
            $table->string('value')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('execution_status_id')->nullable();
            $table->unsignedBigInteger('task_priority_id')->nullable();
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags');
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
        Schema::dropIfExists('condition_value_ojects');
    }
};
