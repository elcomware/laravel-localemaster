<?php

// database/migrations/create_test_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('test_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('field1')->nullable();
            $table->json('field2')->nullable();
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('last_editor')->nullable();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_models');
        Schema::dropIfExists('users');
    }
};
