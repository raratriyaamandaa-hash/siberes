<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailSetoran;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    private const JENIS = [
        'transaksi' => 'Laporan transaksi penyetoran',
        'nasabah' => 'Laporan data nasabah',
        'berat' => 'Laporan total berat sampah',
        'saldo' => 'Laporan saldo tabungan',
    ];

    public function index(Request $request)
    {
        $request->validate([
            'dari' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
        ]);

        $jenis = array_key_exists($request->input('jenis'), self::JENIS) ? $request->input('jenis') : 'transaksi';
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        [$kolom, $baris, $footer] = $this->susun($jenis, $dari, $sampai);

        if ($request->boolean('unduh')) {
            return response()->streamDownload(function () use ($kolom, $baris, $footer) {
                $out = fopen('php://output', 'w');
                fwrite($out, "\xEF\xBB\xBF");
                fputcsv($out, $kolom, ';', '"', '\\');
                foreach ($baris as $b) {
                    fputcsv($out, $b, ';', '"', '\\');
                }
                fputcsv($out, $footer, ';', '"', '\\');
                fclose($out);
            }, 'laporan-'.$jenis.'-'.now()->format('Ymd').'.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
        }

        return view('admin.laporan.index', [
            'daftarJenis' => self::JENIS,
            'jenis' => $jenis,
            'judul' => self::JENIS[$jenis],
            'dari' => $dari,
            'sampai' => $sampai,
            'kolom' => $kolom,
            'baris' => $baris,
            'footer' => $footer,
        ]);
    }

    private function rentang($query, string $kolom, ?string $dari, ?string $sampai)
    {
        return $query
            ->when($dari, fn ($q) => $q->whereDate($kolom, '>=', $dari))
            ->when($sampai, fn ($q) => $q->whereDate($kolom, '<=', $sampai));
    }

    private function detailPeriode(?string $dari, ?string $sampai)
    {
        return $this->rentang(
            DetailSetoran::join('setorans', 'setorans.id', '=', 'detail_setorans.setoran_id'),
            'setorans.tanggal', $dari, $sampai
        );
    }

    private function susun(string $jenis, ?string $dari, ?string $sampai): array
    {
        $rp = fn ($n) => 'Rp '.number_format($n, 0, ',', '.');
        $kg = fn ($n) => number_format($n, 1, ',', '.').' kg';

        if ($jenis === 'transaksi') {
            $data = $this->rentang(Setoran::with(['nasabah.user', 'detail']), 'tanggal', $dari, $sampai)
                ->orderBy('tanggal')->orderBy('id')->get();

            return [
                ['No.', 'Tanggal', 'Nasabah', 'Jenis sampah', 'Berat', 'Total nilai'],
                $data->map(fn ($s) => [
                    'TRX-'.str_pad($s->id, 3, '0', STR_PAD_LEFT),
                    $s->tanggal->format('d/m/Y'),
                    $s->nasabah->user->name,
                    $s->detail->pluck('nama_jenis')->join(', '),
                    $kg($s->total_berat),
                    $rp($s->total),
                ])->all(),
                ['Total', '', '', $data->count().' transaksi', $kg($data->sum(fn ($s) => $s->total_berat)), $rp($data->sum(fn ($s) => $s->total))],
            ];
        }

        if ($jenis === 'nasabah') {
            $data = $this->rentang(Nasabah::with('user')->whereNotNull('kode'), 'created_at', $dari, $sampai)
                ->orderBy('kode')->get();

            return [
                ['ID', 'Nama', 'Email', 'Alamat', 'Telepon', 'Terdaftar'],
                $data->map(fn ($n) => [
                    $n->kode, $n->user->name, $n->user->email, $n->alamat, $n->telepon, $n->created_at->format('d/m/Y'),
                ])->all(),
                ['Total', '', '', '', '', $data->count().' nasabah'],
            ];
        }

        if ($jenis === 'berat') {
            $data = $this->detailPeriode($dari, $sampai)
                ->selectRaw('detail_setorans.nama_jenis, COUNT(DISTINCT detail_setorans.setoran_id) as jml, SUM(detail_setorans.berat) as kg, SUM(detail_setorans.subtotal) as nilai')
                ->groupBy('detail_setorans.nama_jenis')
                ->orderByDesc('kg')->get();
            $totalSetoran = $this->rentang(Setoran::query(), 'tanggal', $dari, $sampai)->count();

            return [
                ['Jenis sampah', 'Jumlah setoran', 'Total berat', 'Total nilai'],
                $data->map(fn ($d) => [$d->nama_jenis, $d->jml.'×', $kg($d->kg), $rp($d->nilai)])->all(),
                ['Total', $totalSetoran.'×', $kg($data->sum('kg')), $rp($data->sum('nilai'))],
            ];
        }

        $nasabah = Nasabah::with('user')->whereNotNull('kode')->orderBy('kode')->get();
        $periode = $this->detailPeriode($dari, $sampai)
            ->selectRaw('setorans.nasabah_id, SUM(detail_setorans.subtotal) as nilai')
            ->groupBy('setorans.nasabah_id')
            ->pluck('nilai', 'nasabah_id');

        return [
            ['ID', 'Nasabah', 'Penambahan pada periode', 'Saldo saat ini'],
            $nasabah->map(fn ($n) => [$n->kode, $n->user->name, $rp($periode[$n->id] ?? 0), $rp($n->saldo)])->all(),
            ['Total', '', $rp($periode->sum()), $rp($nasabah->sum(fn ($n) => $n->saldo))],
        ];
    }
}
