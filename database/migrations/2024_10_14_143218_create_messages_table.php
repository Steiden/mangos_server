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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->boolean('is_read')->default(false);
            $table->unsignedBigInteger('message_type_id');
            $table->unsignedBigInteger('user_sending_id');
            $table->unsignedBigInteger('user_receiving_id')->nullable();
            $table->unsignedBigInteger('chat_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->timestamps();

            $table->foreign('message_type_id')->references('id')->on('message_types');
            $table->foreign('user_sending_id')->references('id')->on('users');
            $table->foreign('user_receiving_id')->references('id')->on('users');
            $table->foreign('chat_id')->references('id')->on('chats');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};