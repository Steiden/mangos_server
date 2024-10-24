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
        Schema::dropIfExists('chat_messages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->unsignedBigInteger('message_id');
            $table->timestamps();

            $table->foreign('chat_id')->references('id')->on('chats');
            $table->foreign('message_id')->references('id')->on('messages');
        });
    }
};
