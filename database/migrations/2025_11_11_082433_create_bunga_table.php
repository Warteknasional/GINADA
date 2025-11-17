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
        Schema::create('bunga', function (Blueprint $table) {

            // UUID sebagai primary key
            $table->uuid('id_bunga')->primary();

            $table->string('nama', 150);

            // pakai enum biar gak bebas input kategori
            $table->enum('kategori', [
                'fresh_flower',
                'artificial_flower',
                'bouquet',
                'tanaman_hias'
            ]);

            $table->integer('stok')->default(0);
            $table->decimal('harga', 12, 2);

            $table->timestamps();
            $table->softDeletes(); // biar bisa delete tanpa hilang dari database
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bunga');
    }
};
