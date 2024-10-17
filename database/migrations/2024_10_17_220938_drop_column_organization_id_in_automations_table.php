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
            $table->dropForeign('automations_organization_id_foreign');
            $table->dropColumn('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('automations', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }
};
