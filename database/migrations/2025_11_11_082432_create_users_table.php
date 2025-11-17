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
            // UUID sebagai PRIMARY KEY
            $table->uuid('id_user')->primary();

            $table->string('name', 100);
            $table->string('email', 100)->unique();

            // Panjang 255 untuk hash password
            $table->string('password', 255);

            $table->enum('role', ['admin', 'customer'])->index();

            $table->rememberToken(); // penting untuk auth
            $table->timestamps();
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
