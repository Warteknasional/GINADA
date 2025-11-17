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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->uuid('id_order')->primary();   // UUID
            $table->string('id_user', 50);

            $table->dateTime('tanggal_pemesanan');
            $table->decimal('total', 12, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'done', 'cancel'])
                  ->default('pending');

            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
