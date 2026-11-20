<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_sampahs', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('nama');
            $table->string('keterangan')->nullable()->after('harga');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_sampahs', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'keterangan']);
        });
    }
};