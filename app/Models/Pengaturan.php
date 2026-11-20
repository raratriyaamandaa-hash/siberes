<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = ['kunci', 'nilai'];

    public static function ambil(string $kunci, $default = null)
    {
        return static::where('kunci', $kunci)->value('nilai') ?? $default;
    }

    public static function simpan(string $kunci, string $nilai): void
    {
        static::updateOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
    }
}