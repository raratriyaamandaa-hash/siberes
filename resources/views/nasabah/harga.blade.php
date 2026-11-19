<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jenis dan Harga Sampah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-3 bg-green-100 text-green-800 rounded text-sm">Harga di bawah berlaku untuk penyetoran berikutnya.</div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($daftar as $j)
                    <div class="bg-white shadow rounded-lg p-5">
                        <div class="font-semibold">{{ $j->nama }}</div>
                        <div class="text-2xl font-bold text-green-800 mt-1">Rp {{ number_format($j->harga, 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-500">per kilogram</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>