<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('condition_value_objects', function (Blueprint $table) {
            $table->dropColumn('task_tag_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_value_objects', function (Blueprint $table) {
            $table->unsignedBigInteger('task_tag_id')->nullable();
        });
    }
};
