<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan</h2>
    </x-slot>

    <style>
        @media print {
            nav, header, .no-print { display: none !important; }
            body { background: #fff; }
        }
    </style>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($errors->any())
                <div class="p-3 bg-red-100 text-red-800 rounded no-print">{{ $errors->first() }}</div>
            @endif

            <form method="GET" action="{{ route('admin.laporan.index') }}" class="no-print bg-white shadow sm:rounded-lg p-6 flex flex-wrap items-end gap-3">
                <div>
                    <label class="block text-sm font-medium">Jenis laporan</label>
                    <select name="jenis" class="border-gray-300 rounded">
                        @foreach ($daftarJenis as $kode => $nama)
                            <option value="{{ $kode }}" @selected($kode === $jenis)>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Dari tanggal</label>
                    <input type="date" name="dari" value="{{ $dari }}" class="border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium">Sampai tanggal</label>
                    <input type="date" name="sampai" value="{{ $sampai }}" class="border-gray-300 rounded">
                </div>
                <button class="px-4 py-2 bg-green-700 text-white rounded">Tampilkan</button>
                <a href="{{ route('admin.laporan.index', array_merge(request()->query(), ['unduh' => 1])) }}" class="px-4 py-2 border border-green-700 text-green-700 rounded">Unduh CSV</a>
                <button type="button" onclick="window.print()" class="px-4 py-2 border border-gray-400 text-gray-700 rounded">Cetak</button>
            </form>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold text-lg">SIBERES – {{ $judul }}</h3>
                <p class="text-sm text-gray-500 mb-4">
                    Periode:
                    {{ $dari ? \Carbon\Carbon::parse($dari)->format('d/m/Y') : 'awal' }}
                    s/d
                    {{ $sampai ? \Carbon\Carbon::parse($sampai)->format('d/m/Y') : 'sekarang' }}
                    · Dicetak {{ now()->format('d/m/Y H:i') }}
                </p>

                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        @foreach ($kolom as $k)
                            <th class="py-2">{{ $k }}</th>
                        @endforeach
                    </tr>
                    @forelse ($baris as $b)
                        <tr class="border-t">
                            @foreach ($b as $sel)
                                <td class="py-2">{{ $sel }}</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($kolom) }}" class="py-3 text-gray-500">Tidak ada data pada periode ini.</td></tr>
                    @endforelse
                    <tr class="border-t-2 font-semibold">
                        @foreach ($footer as $sel)
                            <td class="py-2">{{ $sel }}</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>