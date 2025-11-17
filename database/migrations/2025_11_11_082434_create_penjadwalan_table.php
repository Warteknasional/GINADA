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
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->uuid('id_penjadwalan')->primary();
            $table->uuid('id_bunga');
            
            $table->dateTime('tanggal_pemesanan');
            $table->integer('jumlah');
            $table->string('note', 1024)->nullable();
            $table->timestamps();

            $table->foreign('id_bunga')
                  ->references('id_bunga')
                  ->on('bunga')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalan');
    }
};
