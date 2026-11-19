<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $fillable = ['nasabah_id', 'tanggal'];

    protected $casts = ['tanggal' => 'date'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailSetoran::class);
    }

    public function getTotalAttribute(): int
    {
        return (int) $this->detail->sum('subtotal');
    }

    public function getTotalBeratAttribute(): float
    {
        return (float) $this->detail->sum('berat');
    }
}
