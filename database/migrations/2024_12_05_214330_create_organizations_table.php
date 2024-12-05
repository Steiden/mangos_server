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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->unsignedBigInteger('activity_type_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('activity_type_id')->references('id')->on('activity_types');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
