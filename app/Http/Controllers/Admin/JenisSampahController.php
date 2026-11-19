<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JenisSampahController extends Controller
{
    private function aturan(?int $abaikan = null): array
    {
        return [
            'nama' => ['required', 'string', 'max:100', Rule::unique('jenis_sampahs', 'nama')->ignore($abaikan)],
            'harga' => ['required', 'integer', 'min:0'],
        ];
    }

    private function pesan(): array
    {
        return ['nama.unique' => 'Jenis sampah dengan nama itu sudah ada.'];
    }

    public function index()
    {
        return view('admin.jenis-sampah.index', [
            'daftar' => JenisSampah::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        JenisSampah::create($request->validate($this->aturan(), $this->pesan()));

        return back()->with('status', 'Jenis sampah ditambahkan.');
    }

    public function update(Request $request, JenisSampah $jenis)
    {
        $jenis->update($request->validate($this->aturan($jenis->id), $this->pesan()));

        return back()->with('status', 'Jenis sampah diperbarui.');
    }

    public function destroy(JenisSampah $jenis)
    {
        $jenis->delete();

        return back()->with('status', 'Jenis sampah dihapus.');
    }
}
