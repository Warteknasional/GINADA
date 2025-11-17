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
        Schema::create('nota', function (Blueprint $table) {
            $table->uuid('id_nota')->primary();
            $table->uuid('id_order');
            
            $table->decimal('total_harga', 12, 2);
            $table->dateTime('tanggal_cetak')->default(now());
            
            $table->timestamps();

            $table->foreign('id_order')
                  ->references('id_order')
                  ->on('pesanan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};
