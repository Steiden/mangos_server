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
        Schema::table('automation_editors', function (Blueprint $table) {
            $table->dropForeign('automation_editors_automation_id_foreign');
            $table->foreign('automation_id')->references('id')->on('automations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('automation_editors', function (Blueprint $table) {
            $table->dropForeign('automation_editors_automation_id_foreign');
            $table->foreign('automation_id')->references('id')->on('automations');
        });
    }
};
