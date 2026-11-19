<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table = 'nasabah';

    protected $fillable = ['user_id', 'kode', 'alamat', 'telepon'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class);
    }

    public function penjemputan()
    {
        return $this->hasMany(Penjemputan::class);
    }

    public function getSaldoAttribute(): int
    {
        return (int) DetailSetoran::whereHas('setoran', fn ($q) => $q->where('nasabah_id', $this->id))
            ->sum('subtotal');
    }
}
