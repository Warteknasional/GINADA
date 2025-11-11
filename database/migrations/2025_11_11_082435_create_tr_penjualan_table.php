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
        Schema::create('tr_penjualan', function (Blueprint $table) {
            $table->string('id_penjualan', 255)->primary();
            $table->string('id_order', 255);
            $table->string('id_admin', 50); // yang melayani pesanan
            $table->dateTime('tanggal_penjualan');
            $table->decimal('total_penjualan', 12, 2);
            $table->timestamps();

            $table->foreign('id_order')->references('id_order')->on('pesanan')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_user')->on('users')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_penjualan');
    }
};
