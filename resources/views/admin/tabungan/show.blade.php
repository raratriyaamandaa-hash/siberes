<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Saldo {{ $nasabah->user->name }} ({{ $nasabah->kode }})
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-green-700 text-white rounded-lg p-6">
                <div class="text-sm text-green-100">Saldo saat ini</div>
                <div class="text-3xl font-bold mt-1">Rp {{ number_format($nasabah->saldo, 0, ',', '.') }}</div>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Riwayat penambahan saldo</h3>
                @php $saldoBerjalan = 0; @endphp
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Tanggal</th><th>Transaksi</th><th>Jenis sampah</th><th>Penambahan</th><th>Saldo</th>
                    </tr>
                    @forelse ($setoran as $s)
                        @php $saldoBerjalan += $s->total; @endphp
                        <tr class="border-t">
                            <td class="py-2">{{ $s->tanggal->format('d/m/Y') }}</td>
                            <td>TRX-{{ str_pad($s->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $s->detail->pluck('nama_jenis')->join(', ') }}</td>
                            <td class="text-green-700">+ Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($saldoBerjalan, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-3 text-gray-500">Belum ada penyetoran.</td></tr>
                    @endforelse
                </table>
                <a href="{{ route('admin.tabungan.index') }}" class="inline-block mt-5 text-green-700 font-medium">← Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>