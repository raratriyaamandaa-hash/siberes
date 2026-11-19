<?php

namespace App\Http\Controllers;

use App\Models\DetailSetoran;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return redirect()->route('nasabah.beranda');
        }

        $perBulan = DetailSetoran::join('setorans', 'setorans.id', '=', 'detail_setorans.setoran_id')
            ->selectRaw("DATE_FORMAT(setorans.tanggal, '%Y-%m') as bulan, SUM(detail_setorans.subtotal) as nilai")
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->limit(6)
            ->get()
            ->reverse()
            ->values();

        $perJenis = DetailSetoran::selectRaw('nama_jenis, SUM(berat) as kg')
            ->groupBy('nama_jenis')
            ->orderByDesc('kg')
            ->limit(6)
            ->get();

        return view('dashboard', [
            'totalNasabah' => Nasabah::whereNotNull('kode')->count(),
            'totalTransaksi' => Setoran::count(),
            'totalBerat' => (float) DetailSetoran::sum('berat'),
            'totalTabungan' => (int) DetailSetoran::sum('subtotal'),
            'perBulan' => $perBulan,
            'perJenis' => $perJenis,
            'terbaru' => Setoran::with(['nasabah.user', 'detail'])->latest('tanggal')->latest('id')->limit(6)->get(),
        ]);
    }
}
