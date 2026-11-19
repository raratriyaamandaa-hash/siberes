<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Halo, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="bg-green-700 text-white rounded-lg p-6">
                    <div class="text-sm text-green-100">Saldo tabungan saat ini</div>
                    <div class="text-3xl font-bold mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-sm text-gray-500">Total berat sampah disetor</div>
                    <div class="text-2xl font-semibold text-green-800 mt-1">{{ number_format($totalBerat, 1, ',', '.') }} kg</div>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-sm text-gray-500">Jumlah penyetoran</div>
                    <div class="text-2xl font-semibold text-green-800 mt-1">{{ $jumlah }}×</div>
                </div>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Transaksi terakhir</h3>
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Tanggal</th><th>Jenis sampah</th><th>Berat</th><th>Nilai</th>
                    </tr>
                    @forelse ($terakhir as $s)
                        <tr class="border-t">
                            <td class="py-2">{{ $s->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $s->detail->pluck('nama_jenis')->join(', ') }}</td>
                            <td>{{ number_format($s->total_berat, 1, ',', '.') }} kg</td>
                            <td>Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="py-3 text-gray-500">Belum ada penyetoran. Setoran Anda akan muncul di sini setelah dicatat admin.</td></tr>
                    @endforelse
                </table>
                <a href="{{ route('nasabah.riwayat') }}" class="inline-block mt-4 text-green-700 font-medium">Lihat semua riwayat</a>
            </div>
        </div>
    </div>
</x-app-layout>