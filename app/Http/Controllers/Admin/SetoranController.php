<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetoranController extends Controller
{
    public function index()
    {
        return view('admin.setoran.index', [
            'nasabah' => Nasabah::with('user')->whereNotNull('kode')->orderBy('kode')->get(),
            'jenis' => JenisSampah::orderBy('nama')->get(),
            'riwayat' => Setoran::with(['nasabah.user', 'detail'])->latest('tanggal')->latest('id')->get(),
            'pilih' => request('nasabah'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nasabah_id' => ['required', 'exists:nasabah,id'],
            'tanggal' => ['required', 'date'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.jenis_sampah_id' => ['required', 'exists:jenis_sampahs,id'],
            'items.*.berat' => ['required', 'numeric', 'gt:0'],
        ]);

        $setoran = DB::transaction(function () use ($data) {
            $setoran = Setoran::create([
                'nasabah_id' => $data['nasabah_id'],
                'tanggal' => $data['tanggal'],
            ]);

            foreach ($data['items'] as $item) {
                $jenis = JenisSampah::findOrFail($item['jenis_sampah_id']);
                $setoran->detail()->create([
                    'jenis_sampah_id' => $jenis->id,
                    'nama_jenis' => $jenis->nama,
                    'berat' => $item['berat'],
                    'harga' => $jenis->harga,
                    'subtotal' => (int) round($item['berat'] * $jenis->harga),
                ]);
            }

            return $setoran->load('detail');
        });

        return redirect()->route('admin.setoran.index')
            ->with('status', 'Transaksi tersimpan. Saldo nasabah bertambah Rp '.number_format($setoran->total, 0, ',', '.').'.');
    }

    public function show(Setoran $setoran)
    {
        $setoran->load(['nasabah.user', 'detail']);

        return view('admin.setoran.show', compact('setoran'));
    }
}
