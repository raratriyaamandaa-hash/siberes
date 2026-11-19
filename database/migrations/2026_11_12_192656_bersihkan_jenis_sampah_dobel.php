<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $kelompok = DB::table('jenis_sampahs')->orderBy('id')->get()
            ->groupBy(fn ($j) => mb_strtolower(trim($j->nama)));

        foreach ($kelompok as $grup) {
            $utama = $grup->first();

            foreach ($grup->skip(1) as $dobel) {
                DB::table('detail_setorans')
                    ->where('jenis_sampah_id', $dobel->id)
                    ->update(['jenis_sampah_id' => $utama->id]);

                DB::table('jenis_sampahs')->where('id', $dobel->id)->delete();
            }

            DB::table('detail_setorans')
                ->whereRaw('LOWER(TRIM(nama_jenis)) = ?', [mb_strtolower(trim($utama->nama))])
                ->update(['nama_jenis' => $utama->nama]);
        }

        Schema::table('jenis_sampahs', function (Blueprint $table) {
            $table->unique('nama');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_sampahs', function (Blueprint $table) {
            $table->dropUnique(['nama']);
        });
    }
};