<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSetoran extends Model
{
    protected $fillable = ['setoran_id', 'jenis_sampah_id', 'nama_jenis', 'berat', 'harga', 'subtotal'];

    public function setoran()
    {
        return $this->belongsTo(Setoran::class);
    }
}
