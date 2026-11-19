<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Penyetoran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Tanggal</th><th>Jenis sampah</th><th>Berat</th><th>Harga / kg</th><th>Total nilai</th><th>Status</th>
                    </tr>
                    @forelse ($setoran as $s)
                        @foreach ($s->detail as $d)
                            <tr class="border-t">
                                <td class="py-2">{{ $s->tanggal->format('d/m/Y') }}</td>
                                <td>{{ $d->nama_jenis }}</td>
                                <td>{{ number_format($d->berat, 2, ',', '.') }} kg</td>
                                <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                <td><span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-medium">Berhasil</span></td>
                            </tr>
                        @endforeach
                    @empty
                        <tr><td colspan="6" class="py-3 text-gray-500">Belum ada penyetoran.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>