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
    Schema::create('penjemputans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('nasabah_id')->constrained('nasabah')->cascadeOnDelete();
        $table->date('tanggal');
        $table->string('jenis');
        $table->string('catatan')->nullable();
        $table->string('status')->default('menunggu'); // menunggu, selesai, dibatalkan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjemputans');
    }
};
