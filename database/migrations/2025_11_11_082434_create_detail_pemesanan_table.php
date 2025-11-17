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
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->uuid('id_detail')->primary();
            $table->uuid('id_order');
            $table->uuid('id_bunga');

            $table->integer('jumlah'); // qty
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->timestamps();

            $table->foreign('id_order')
                ->references('id_order')
                ->on('pesanan')
                ->onDelete('cascade');

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
        Schema::dropIfExists('detail_pemesanan');
    }
};
