<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    private function nasabah ()
    {
        return request()->user()->nasabah;
    }

    public function beranda ()
    {
        $n = $this->nasabah();
        $setoran = $n->setoran()->with('detail')->latest('tanggal')->latest('id')->get();

        return view('nasabah.beranda', [
            'saldo' => $n->saldo,
            'totalBerat' => $setoran->sum(fn ($s) => $s->total_berat),
            'jumlah' => $setoran->count(),
            'terakhir' => $setoran->take(4),
        ]);
    }

    public function riwayat()
    {
        $setoran = $this->nasabah()->setoran()->with('detail')->latest('tanggal')->latest('id')->get();

        return view('nasabah.riwayat', compact('setoran'));
    }

    public function harga()
    {
        return view('nasabah.harga', ['daftar' => JenisSampah::orderBy('id')->get(), 'periode' => \App\Models\Pengaturan::ambil('periode_harga', config('profil.periode_harga'))]);
    }

    public function notifikasi()
{
    $n = $this->nasabah();
    $notif = collect();

    foreach ($n->setoran()->with('detail')->get() as $s) {
        $notif->push([
            'waktu' => $s->created_at,
            'pesan' => 'Penyetoran '.number_format($s->total_berat, 1, ',', '.').' kg ('
                .$s->detail->pluck('nama_jenis')->join(', ').') berhasil dicatat admin. Saldo bertambah Rp '
                .number_format($s->total, 0, ',', '.').'.',
        ]);
    }

    foreach ($n->penjemputan as $p) {
        $notif->push([
            'waktu' => $p->updated_at,
            'pesan' => 'Permintaan penjemputan tanggal '.$p->tanggal->format('d/m/Y').': '.$p->status.'.',
        ]);
    }

    return view('nasabah.notifikasi', [
        'notif' => $notif->sortByDesc(fn ($x) => $x['waktu']->timestamp)->values(),
    ]);
}
}
