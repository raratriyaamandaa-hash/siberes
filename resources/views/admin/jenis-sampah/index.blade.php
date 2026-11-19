<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jenis dan Harga Sampah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="font-semibold mb-3">Tambah jenis sampah</h3>
                <form method="POST" action="{{ route('admin.jenis-sampah.store') }}" class="flex flex-wrap items-center gap-2">
                    @csrf
                    <input name="nama" placeholder="Nama jenis" class="border-gray-300 rounded flex-1 min-w-[180px]" required>
                    <span class="text-gray-500 text-sm">Rp</span>
                    <input name="harga" type="number" min="0" placeholder="Harga" class="border-gray-300 rounded w-32" required>
                    <span class="text-gray-500 text-sm">/ kg</span>
                    <button class="px-3 py-2 bg-green-700 text-white rounded">Tambah</button>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="font-semibold mb-1">Daftar jenis dan harga berlaku</h3>
                @forelse ($daftar as $j)
                    <div class="flex flex-wrap items-center gap-2 border-t py-3">
                        <form method="POST" action="{{ route('admin.jenis-sampah.update', $j) }}" class="flex flex-wrap items-center gap-2 flex-1">
                            @csrf @method('PUT')
                            <input name="nama" value="{{ $j->nama }}" class="border-gray-300 rounded flex-1 min-w-[180px]" required>
                            <span class="text-gray-500 text-sm">Rp</span>
                            <input name="harga" type="number" min="0" value="{{ $j->harga }}" class="border-gray-300 rounded w-32" required>
                            <span class="text-gray-500 text-sm">/ kg</span>
                            <button class="px-3 py-1 bg-green-700 text-white rounded">Simpan</button>
                        </form>
                        <form method="POST" action="{{ route('admin.jenis-sampah.destroy', $j) }}"
                              onsubmit="return confirm('Hapus jenis sampah ini?')">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="py-3 text-gray-500">Belum ada jenis sampah.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>