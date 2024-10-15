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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('patronymic')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->boolean('is_subordinate')->default(false);
            $table->dateTime('verified_at')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->timestamps();
            
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
