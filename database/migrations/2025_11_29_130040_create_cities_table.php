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
    Schema::create('cities', function (Blueprint $table) {
        $table->id();
        // Setiap kota milik satu Area (yang punya harga)
        $table->foreignId('area_id')->constrained('area')->onDelete('cascade'); 
        $table->string('name'); // Nama Kota/Kecamatan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
