<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailSetoran;
use App\Models\Nasabah;

class TabunganController extends Controller
{
    public function index()
    {
        return view('admin.tabungan.index', [
            'nasabah' => Nasabah::with('user')->withCount('setoran')->whereNotNull('kode')->orderBy('kode')->get(),
            'totalAkumulasi' => (int) DetailSetoran::sum('subtotal'),
        ]);
    }

    public function show(Nasabah $nasabah)
    {
        $nasabah->load('user');
        $setoran = $nasabah->setoran()->with('detail')->orderBy('tanggal')->orderBy('id')->get();

        return view('admin.tabungan.show', compact('nasabah', 'setoran'));
    }
}
