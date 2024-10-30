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
        Schema::table('automations', function (Blueprint $table) {
            $table->dropForeign('automations_automation_condition_id_foreign');
            $table->foreign('automation_condition_id')->references('id')->on('automation_conditions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('automations', function (Blueprint $table) {
            $table->dropForeign('automations_automation_condition_id_foreign');
            $table->foreign('automation_condition_id')->references('id')->on('automation_conditions');
        });
    }
};
