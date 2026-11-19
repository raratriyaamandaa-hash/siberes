
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.setoran.index') }}" class="px-4 py-2 rounded-lg bg-[#176B36] text-white text-sm font-medium hover:opacity-90 transition">+ Catat transaksi</a>
                <a href="{{ route('admin.nasabah.index') }}" class="px-4 py-2 rounded-lg border border-[#176B36] text-[#176B36] text-sm font-medium hover:bg-[#E5F5E9] transition">Verifikasi nasabah</a>
                <a href="{{ route('admin.penjemputan.index') }}" class="px-4 py-2 rounded-lg border border-[#176B36] text-[#176B36] text-sm font-medium hover:bg-[#E5F5E9] transition">Jadwal penjemputan</a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Total nasabah', $totalNasabah],
                    ['Total transaksi', $totalTransaksi],
                    ['Total berat sampah', number_format($totalBerat, 1, ',', '.').' kg'],
                    ['Total tabungan', 'Rp '.number_format($totalTabungan, 0, ',', '.')],
                ] as [$label, $nilai])
                    <div class="bg-white shadow rounded-lg p-5">
                        <div class="text-sm text-gray-500">{{ $label }}</div>
                        <div class="text-2xl font-semibold text-green-800 mt-1">{{ $nilai }}</div>
                    </div>
                @endforeach
            </div>

            <div class="grid gap-4 lg:grid-cols-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="font-semibold mb-3">Nilai penyetoran per bulan</h3>
                    @php $maksBulan = max($perBulan->max('nilai'), 1); @endphp
                    @forelse ($perBulan as $b)
                        <div class="flex items-center gap-3 my-2 text-sm">
                            <span class="w-20 shrink-0">{{ \Carbon\Carbon::createFromFormat('!Y-m', $b->bulan)->format('M Y') }}</span>
                            <div class="flex-1 h-3 bg-green-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-700 rounded-full" style="width: {{ $b->nilai / $maksBulan * 100 }}%"></div>
                            </div>
                            <span class="w-28 text-right">Rp {{ number_format($b->nilai, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="text-center py-6"><div class="mx-auto mb-2 w-10 h-10 rounded-full bg-[#E5F5E9] text-[#176B36] flex items-center justify-center"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 19c0-9 5-14 15-14 0 10-5 15-14 15"/><path d="M5 19c3-5 6-8 10-10"/></svg></div><p class="text-sm text-gray-500">Belum ada data. Grafik muncul setelah ada transaksi.</p></div>
                    @endforelse
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="font-semibold mb-3">Jenis sampah terbanyak disetor</h3>
                    @php $maksJenis = max($perJenis->max('kg'), 1); @endphp
                    @forelse ($perJenis as $j)
                        <div class="flex items-center gap-3 my-2 text-sm">
                            <span class="w-32 shrink-0 truncate">{{ $j->nama_jenis }}</span>
                            <div class="flex-1 h-3 bg-green-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-700 rounded-full" style="width: {{ $j->kg / $maksJenis * 100 }}%"></div>
                            </div>
                            <span class="w-20 text-right">{{ number_format($j->kg, 1, ',', '.') }} kg</span>
                        </div>
                    @empty
                        <div class="text-center py-6"><div class="mx-auto mb-2 w-10 h-10 rounded-full bg-[#E5F5E9] text-[#176B36] flex items-center justify-center"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 19c0-9 5-14 15-14 0 10-5 15-14 15"/><path d="M5 19c3-5 6-8 10-10"/></svg></div><p class="text-sm text-gray-500">Belum ada data. Grafik muncul setelah ada transaksi.</p></div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Aktivitas transaksi terbaru</h3>
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Tanggal</th><th>Nasabah</th><th>Jenis</th><th>Berat</th><th>Nilai</th>
                    </tr>
                    @forelse ($terbaru as $s)
                        <tr class="border-t">
                            <td class="py-2">{{ $s->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $s->nasabah->user->name }}</td>
                            <td>{{ $s->detail->pluck('nama_jenis')->join(', ') }}</td>
                            <td>{{ number_format($s->total_berat, 1, ',', '.') }} kg</td>
                            <td>Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-6 text-center text-gray-500">Belum ada transaksi. <a href="{{ route('admin.setoran.index') }}" class="text-[#176B36] font-medium">Catat transaksi pertama</a></td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
