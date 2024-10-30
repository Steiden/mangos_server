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
        Schema::table('automation_conditions', function (Blueprint $table) {
            $table->dropForeign('automation_conditions_condition_object_id_foreign');
            $table->foreign('condition_object_id')->references('id')->on('condition_objects')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('automation_conditions', function (Blueprint $table) {
            $table->dropForeign('automation_conditions_condition_object_id_foreign');
            $table->foreign('condition_object_id')->references('id')->on('condition_objects');
        });
    }
};
