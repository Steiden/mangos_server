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
        Schema::create('automation_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('condition_object_id');
            $table->unsignedBigInteger('comparison_type_id');
            $table->unsignedBigInteger('condition_value_object_id');
            $table->timestamps();

            $table->foreign('condition_object_id')->references('id')->on('condition_objects');
            $table->foreign('comparison_type_id')->references('id')->on('comparison_types');
            $table->foreign('condition_value_object_id')->references('id')->on('condition_value_objects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automation_conditions');
    }
};
