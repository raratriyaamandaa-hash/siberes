<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\Penjemputan;
use Illuminate\Http\Request;

class PermintaanJemputController extends Controller
{
    public function index(Request $request)
    {
        return view('nasabah.penjemputan', [
            'jenis' => JenisSampah::orderBy('nama')->get(),
            'daftar' => $request->user()->nasabah->penjemputan()->latest('tanggal')->latest('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jenis' => ['required', 'array', 'min:1'],
            'jenis.*' => ['exists:jenis_sampahs,id'],
            'catatan' => ['nullable', 'string', 'max:255'],
        ]);

        $request->user()->nasabah->penjemputan()->create([
            'tanggal' => $data['tanggal'],
            'jenis' => JenisSampah::whereIn('id', $data['jenis'])->orderBy('nama')->pluck('nama')->join(', '),
            'catatan' => $data['catatan'] ?? null,
        ]);

        return back()->with('status', 'Permintaan penjemputan dikirim.');
    }

    public function batal(Request $request, Penjemputan $penjemputan)
    {
        abort_unless($penjemputan->nasabah_id === $request->user()->nasabah->id, 403);

        if ($penjemputan->status === 'menunggu') {
            $penjemputan->update(['status' => 'dibatalkan']);
        }

        return back()->with('status', 'Permintaan dibatalkan.');
    }
}
