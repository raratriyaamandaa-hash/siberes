<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jenis dan Harga Sampah</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-3 bg-green-100 text-green-800 rounded text-sm">
                @if ($periode) Periode: {{ $periode }}. @endif Harga berlaku untuk penyetoran berikutnya dan dapat berubah sewaktu-waktu.
            </div>
            <x-daftar-harga :jenis="$daftar" />
        </div>
    </div>
</x-app-layout>