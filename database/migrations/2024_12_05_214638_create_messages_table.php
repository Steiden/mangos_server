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
            $table->boolean('is_read');
            $table->unsignedBigInteger('message_type_id');
            $table->unsignedBigInteger('user_sending');
            $table->unsignedBigInteger('user_receiving')->nullable();
            $table->unsignedBigInteger('chat_id')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->timestamps();

            $table->foreign('message_type_id')->references('id')->on('message_types')->onDelete('cascade');
            $table->foreign('user_sending')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_receiving')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
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
