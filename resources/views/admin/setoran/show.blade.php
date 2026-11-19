<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail TRX-{{ str_pad($setoran->id, 3, '0', STR_PAD_LEFT) }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <p><b>Nasabah:</b> {{ $setoran->nasabah->kode }} – {{ $setoran->nasabah->user->name }}</p>
                <p><b>Tanggal:</b> {{ $setoran->tanggal->format('d/m/Y') }}</p>

                <table class="w-full text-sm mt-4">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Jenis sampah</th><th>Berat</th><th>Harga / kg</th><th class="text-right">Subtotal</th>
                    </tr>
                    @foreach ($setoran->detail as $d)
                        <tr class="border-t">
                            <td class="py-2">{{ $d->nama_jenis }}</td>
                            <td>{{ number_format($d->berat, 2, ',', '.') }} kg</td>
                            <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="border-t font-semibold">
                        <td class="py-2" colspan="3">Total</td>
                        <td class="text-right">Rp {{ number_format($setoran->total, 0, ',', '.') }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.setoran.index') }}" class="inline-block mt-5 text-green-700 font-medium">← Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>