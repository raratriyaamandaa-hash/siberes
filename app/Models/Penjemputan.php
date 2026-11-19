<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    protected $fillable = ['nasabah_id', 'tanggal', 'jenis', 'catatan', 'status'];

    protected $casts = ['tanggal' => 'date'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
