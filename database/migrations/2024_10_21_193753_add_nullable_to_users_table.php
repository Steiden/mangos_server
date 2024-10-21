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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->default(2)->change();
            $table->unsignedBigInteger('post_id')->nullable()->change();
            $table->unsignedBigInteger('division_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->change();
            $table->unsignedBigInteger('post_id')->change();
            $table->unsignedBigInteger('division_id')->change();
        });
    }
};
