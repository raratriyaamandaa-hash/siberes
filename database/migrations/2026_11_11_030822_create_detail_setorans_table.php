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
        Schema::create('detail_setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setoran_id')->constrained('setorans')->cascadeOnDelete();
            $table->foreignId('jenis_sampah_id')->nullable()->constrained('jenis_sampahs')->nullOnDelete();
            $table->string('nama_jenis');
            $table->decimal('berat', 8, 2);
            $table->unsignedInteger('harga');
            $table->unsignedBigInteger('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_setorans');
    }
};
