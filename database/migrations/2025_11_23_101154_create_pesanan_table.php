<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            
            // relasi ke user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // relasi ke area (ongkir)
            $table->foreignId('area_id')
                ->nullable()
                ->constrained('area')
                ->onDelete('set null');

            $table->string('kode_pesanan')->unique();
            $table->integer('total_harga')->default(0);

            // biaya ongkir per area
            $table->integer('ongkir')->default(0);

            $table->enum('status', [
                'pending', 
                'dibayar', // <--- TAMBAHKAN INI
                'diproses', 
                'siap', 
                'dikirim', 
                'selesai', 
                'dibatalkan'
            ])->default('pending');

            $table->text('catatan')->nullable();
            $table->string('alamat_kirim');
            $table->date('tanggal_pengiriman')->nullable();
            $table->string('waktu_pengiriman')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
