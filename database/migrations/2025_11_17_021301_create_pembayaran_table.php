<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('id_pembayaran', 255)->primary();

            $table->string('id_order', 255);
            $table->foreign('id_order')
                ->references('id_order')
                ->on('pesanan')
                ->onDelete('cascade');

            $table->enum('metode', ['transfer', 'cod', 'qris']);
            $table->enum('status', ['pending', 'dibayar', 'gagal'])->default('pending');
            $table->string('bukti_transfer')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
