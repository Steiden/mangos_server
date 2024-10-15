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
            $table->string('attribute_name');
            $table->string('value');
            $table->unsignedBigInteger('task_tag_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('execution_status_id');
            $table->unsignedBigInteger('task_priority_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_value_objects');
    }
};
