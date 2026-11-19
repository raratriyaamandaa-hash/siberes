<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notifikasi</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg divide-y">
                @forelse ($notif as $x)
                    <div class="p-4">
                        <div class="text-sm">{{ $x['pesan'] }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $x['waktu']->format('d/m/Y H:i') }}</div>
                    </div>
                @empty
                    <div class="p-6 text-gray-500">Belum ada notifikasi.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>