<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class JenisSampahController extends Controller
{
    private function aturan(?int $abaikan = null): array
    {
        return [
            'nama' => ['required', 'string', 'max:100', Rule::unique('jenis_sampahs', 'nama')->ignore($abaikan)],
            'harga' => ['required', 'integer', 'min:0'],
            'kategori' => ['nullable', 'string', 'max:50'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function pesan(): array
    {
        return ['nama.unique' => 'Jenis sampah dengan nama itu sudah ada.'];
    }

    public function index()
    {
        $daftar = JenisSampah::orderBy('id')->get();

        return view('admin.jenis-sampah.index', [
            'daftar' => $daftar,
            'periode' => Pengaturan::ambil('periode_harga', config('profil.periode_harga')),
            'terakhir' => $daftar->max('updated_at'),
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

    public function perbaruiHarga(Request $request)
    {
        $data = $request->validate([
            'harga' => ['required', 'array'],
            'harga.*' => ['required', 'integer', 'min:0'],
            'periode' => ['nullable', 'string', 'max:60'],
        ], [
            'harga.*.required' => 'Ada kolom harga yang kosong. Isi semua kolom harga.',
            'harga.*.integer' => 'Harga harus berupa angka bulat, tanpa titik atau koma.',
            'harga.*.min' => 'Harga tidak boleh negatif.',
        ]);

        $berubah = 0;

        DB::transaction(function () use ($data, &$berubah) {
            foreach (JenisSampah::whereIn('id', array_keys($data['harga']))->get() as $j) {
                $baru = (int) $data['harga'][$j->id];

                if ((int) $j->harga !== $baru) {
                    $j->update(['harga' => $baru]);
                    $berubah++;
                }
            }

            Pengaturan::simpan('periode_harga', (string) ($data['periode'] ?? ''));
        });

        return back()->with('status', $berubah > 0
            ? "{$berubah} harga berhasil diperbarui."
            : 'Tidak ada harga yang berubah.');
    }
}