<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjemputan;

class JadwalJemputController extends Controller
{
    public function index()
    {
        return view('admin.penjemputan.index', [
            'daftar' => Penjemputan::with('nasabah.user')
                ->orderByRaw("status = 'menunggu' desc")
                ->orderBy('tanggal')
                ->get(),
        ]);
    }

    public function selesai(Penjemputan $penjemputan)
    {
        if ($penjemputan->status === 'menunggu') {
            $penjemputan->update(['status' => 'selesai']);
        }

        return redirect()
            ->route('admin.setoran.index', ['nasabah' => $penjemputan->nasabah_id])
            ->with('status', 'Penjemputan selesai. Silakan catat berat sampahnya.');
    }

    public function batal(Penjemputan $penjemputan)
    {
        if ($penjemputan->status === 'menunggu') {
            $penjemputan->update(['status' => 'dibatalkan']);
        }

        return back()->with('status', 'Penjemputan dibatalkan.');
    }
}
