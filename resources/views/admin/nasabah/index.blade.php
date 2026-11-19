<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Nasabah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Menunggu verifikasi ({{ $menunggu->count() }})</h3>
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">Nama</th><th>Email</th><th>Alamat</th><th>Telepon</th><th></th>
                    </tr>
                    @forelse ($menunggu as $u)
                        <tr class="border-t">
                            <td class="py-2">{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->nasabah?->alamat }}</td>
                            <td>{{ $u->nasabah?->telepon }}</td>
                            <td class="flex gap-2 py-2">
                                <form method="POST" action="{{ route('admin.nasabah.setujui', $u) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-green-700 text-white rounded">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('admin.nasabah.tolak', $u) }}"
                                      onsubmit="return confirm('Tolak pendaftaran ini?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded">Tolak</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-3 text-gray-500">Tidak ada pendaftaran baru.</td></tr>
                    @endforelse
                </table>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Nasabah aktif ({{ $aktif->count() }})</h3>
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">ID</th><th>Nama</th><th>Email</th><th>Alamat</th><th>Telepon</th>
                    </tr>
                    @forelse ($aktif as $n)
                         <tr class="border-t">
                <td class="py-2">{{ $n->kode }}</td>
                <td>{{ $n->user->name }}</td>
                <td>{{ $n->user->email }}</td>
                <td>{{ $n->alamat }}</td>
                <td>{{ $n->telepon }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.nasabah.reset', $n->user) }}"
                          onsubmit="return confirm('Reset password nasabah ini?')">
                        @csrf
                        <button class="px-3 py-1 border border-gray-400 text-gray-700 rounded">Reset password</button>
                    </form>
                </td>
            </tr>
                    @empty
                        <tr><td colspan="6" class="py-3 text-gray-500">Belum ada nasabah aktif.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
