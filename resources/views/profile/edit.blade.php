<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profil Saya</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (auth()->user()->role === 'nasabah')
                @php $n = auth()->user()->nasabah; @endphp
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h3 class="font-semibold mb-3">Data nasabah</h3>
                    <table class="text-sm">
                        @foreach ([
                            ['Nama lengkap', auth()->user()->name],
                            ['ID nasabah', $n->kode],
                            ['Email (untuk login)', auth()->user()->email],
                            ['Alamat', $n->alamat],
                            ['Nomor telepon', $n->telepon],
                            ['Terdaftar sejak', $n->created_at->format('d/m/Y')],
                        ] as [$label, $nilai])
                            <tr>
                                <td class="py-1 pe-6 text-gray-500">{{ $label }}</td>
                                <td class="py-1 font-medium">{{ $nilai }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <p class="text-xs text-gray-500 mt-3">Untuk mengubah data ini, hubungi pengelola bank sampah.</p>
                </div>
            @else
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>