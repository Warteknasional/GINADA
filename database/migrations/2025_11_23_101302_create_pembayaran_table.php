<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained('pesanan')->onDelete('cascade');
            $table->integer('jumlah_bayar');
            $table->enum('metode', ['transfer', 'cod', 'qris']);
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
            $table->string('bukti_bayar')->nullable(); // foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
