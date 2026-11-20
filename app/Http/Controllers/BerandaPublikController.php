<?php

namespace App\Http\Controllers;

use App\Models\DetailSetoran;
use App\Models\JenisSampah;

class BerandaPublikController extends Controller
{
    public function __invoke()
    {
        $peringkat = collect();

        if (config('profil.tampil_peringkat', true)) {
            $peringkat = DetailSetoran::join('setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')
                ->join('nasabah', 'nasabah.id', '=', 'setorans.nasabah_id')
                ->join('users', 'users.id', '=', 'nasabah.user_id')
                ->where('users.status', 'aktif')
                ->selectRaw('nasabah.id, users.name, SUM(detail_setorans.berat) as total_kg, COUNT(DISTINCT setorans.id) as jumlah')
                ->groupBy('nasabah.id', 'users.name')
                ->orderByDesc('total_kg')
                ->limit(5)
                ->get();
        }

        return view('welcome', [
            'jenis' => JenisSampah::orderBy('id')->get(),
            'periodeHarga' => \App\Models\Pengaturan::ambil('periode_harga', config('profil.periode_harga')),
            'peringkat' => $peringkat,
        ]);
    }
}