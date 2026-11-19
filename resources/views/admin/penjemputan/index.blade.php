<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Penjemputan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <div class="p-3 bg-green-100 text-green-800 rounded text-sm">
                Penjemputan dilayani setiap hari. {{ $daftar->where('status', 'menunggu')->count() }} permintaan menunggu.
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Tanggal</th><th>Nasabah</th><th>Alamat</th><th>Telepon</th><th>Perkiraan sampah</th><th>Catatan</th><th>Status</th><th></th>
                    </tr>
                    @forelse ($daftar as $p)
                        <tr class="border-t">
                            <td class="py-2">{{ $p->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $p->nasabah->user->name }}</td>
                            <td>{{ $p->nasabah->alamat }}</td>
                            <td>{{ $p->nasabah->telepon }}</td>
                            <td>{{ $p->jenis }}</td>
                            <td>{{ $p->catatan ?: '-' }}</td>
                            <td>
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $p->status === 'selesai' ? 'bg-green-100 text-green-800' : ($p->status === 'menunggu' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="flex gap-2 py-2">
                                @if ($p->status === 'menunggu')
                                    <form method="POST" action="{{ route('admin.penjemputan.selesai', $p) }}">
                                        @csrf
                                        <button class="px-3 py-1 bg-green-700 text-white rounded">Sudah dijemput</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.penjemputan.batal', $p) }}" onsubmit="return confirm('Batalkan penjemputan ini?')">
                                        @csrf
                                        <button class="px-3 py-1 border border-red-600 text-red-600 rounded">Batalkan</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="py-3 text-gray-500">Belum ada permintaan penjemputan.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>