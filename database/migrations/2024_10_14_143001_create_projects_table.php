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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('execution_status_id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('chat_id');
            $table->timestamps();

            $table->foreign('execution_status_id')->references('id')->on('execution_statuses');
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('chat_id')->references('id')->on('chats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
