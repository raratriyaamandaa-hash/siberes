<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Penjemputan Sampah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
            @endif

            <div class="p-3 bg-green-100 text-green-800 rounded text-sm">
                Petugas menjemput sampah setiap hari. Pilih tanggal yang Anda inginkan.
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="font-semibold">Minta penjemputan</h3>
                <form method="POST" action="{{ route('nasabah.penjemputan.store') }}" class="mt-3 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}" required class="border-gray-300 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Perkiraan jenis sampah (boleh lebih dari satu)</label>
                        <div class="flex flex-wrap gap-x-4 gap-y-2">
                            @foreach ($jenis as $j)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox" name="jenis[]" value="{{ $j->id }}" class="rounded border-gray-300 text-green-700">
                                    {{ $j->nama }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Catatan</label>
                        <input type="text" name="catatan" placeholder="Mis. taruh di depan pagar" class="border-gray-300 rounded w-full">
                    </div>
                    <button class="px-4 py-2 bg-green-700 text-white rounded">Minta penjemputan</button>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Permintaan saya</h3>
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Tanggal</th><th>Perkiraan sampah</th><th>Catatan</th><th>Status</th><th></th>
                    </tr>
                    @forelse ($daftar as $p)
                        <tr class="border-t">
                            <td class="py-2">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $p->jenis }}</td>
                            <td>{{ $p->catatan ?: '-' }}</td>
                            <td>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $p->status === 'selesai' ? 'bg-green-100 text-green-800' : ($p->status === 'menunggu' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($p->status === 'menunggu')
                                    <form method="POST" action="{{ route('nasabah.penjemputan.batal', $p) }}" onsubmit="return confirm('Batalkan permintaan ini?')">
                                        @csrf
                                        <button class="text-red-600 font-medium">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-3 text-gray-500">Belum ada permintaan.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>