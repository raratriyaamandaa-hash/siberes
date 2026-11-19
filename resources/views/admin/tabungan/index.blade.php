<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Tabungan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-green-700 text-white rounded-lg p-6">
                <div class="text-sm text-green-100">Total akumulasi tabungan seluruh nasabah</div>
                <div class="text-3xl font-bold mt-1">Rp {{ number_format($totalAkumulasi, 0, ',', '.') }}</div>
            </div>

            <div class="p-3 bg-green-100 text-green-800 rounded text-sm">
                Saldo hanya bertambah dari transaksi penyetoran yang dicatat admin.
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">ID</th><th>Nasabah</th><th>Jumlah setoran</th><th>Saldo</th><th></th>
                    </tr>
                    @forelse ($nasabah as $n)
                        <tr class="border-t">
                            <td class="py-2">{{ $n->kode }}</td>
                            <td>{{ $n->user->name }}</td>
                            <td>{{ $n->setoran_count }}×</td>
                            <td class="font-semibold">Rp {{ number_format($n->saldo, 0, ',', '.') }}</td>
                            <td><a href="{{ route('admin.tabungan.show', $n) }}" class="text-green-700 font-medium">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-3 text-gray-500">Belum ada nasabah aktif.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>