@php
    $admin = auth()->user()->role === 'admin';

    $ikon = [
        'grid' => '<path d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/>',
        'user' => '<circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>',
        'tag' => '<path d="M3 12V4h8l10 10-8 8L3 12z"/><circle cx="7.5" cy="8.5" r="1"/>',
        'swap' => '<path d="M4 8h14l-4-4M20 16H6l4 4"/>',
        'coin' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 10c0-1.2 1.3-2 3-2s3 .8 3 2-1.3 2-3 2-3 .8-3 2 1.3 2 3 2 3-.8 3-2"/>',
        'truck' => '<path d="M3 6h11v10H3zM14 9h4l3 3v4h-7"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>',
        'doc' => '<path d="M6 3h8l4 4v14H6zM14 3v4h4M9 12h6M9 16h6"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'bell' => '<path d="M6 16v-5a6 6 0 0112 0v5l2 2H4zM10 20a2 2 0 004 0"/>',
    ];

    $menu = $admin ? [
        ['dashboard', 'dashboard', 'Dashboard', 'grid'],
        ['admin.nasabah.index', 'admin.nasabah.*', 'Data Nasabah', 'user'],
        ['admin.jenis-sampah.index', 'admin.jenis-sampah.*', 'Jenis & Harga', 'tag'],
        ['admin.setoran.index', 'admin.setoran.*', 'Transaksi', 'swap'],
        ['admin.tabungan.index', 'admin.tabungan.*', 'Tabungan', 'coin'],
        ['admin.penjemputan.index', 'admin.penjemputan.*', 'Penjemputan', 'truck'],
        ['admin.laporan.index', 'admin.laporan.*', 'Laporan', 'doc'],
    ] : [
        ['nasabah.beranda', 'nasabah.beranda', 'Beranda', 'grid'],
        ['nasabah.riwayat', 'nasabah.riwayat', 'Riwayat Setoran', 'clock'],
        ['nasabah.harga', 'nasabah.harga', 'Harga Sampah', 'tag'],
        ['nasabah.penjemputan.index', 'nasabah.penjemputan.*', 'Penjemputan', 'truck'],
        ['nasabah.notifikasi', 'nasabah.notifikasi', 'Notifikasi', 'bell'],
    ];
@endphp

<aside :class="open ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 flex flex-col transition-transform duration-200 lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen lg:shrink-0">
    <div class="h-16 px-5 flex items-center justify-between border-b border-gray-100">
        <a href="{{ route('dashboard') }}"><x-logo /></a>
        <button @click="open = false" aria-label="Tutup menu" class="lg:hidden p-1 text-gray-500 hover:text-gray-700">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        @foreach ($menu as [$rute, $pola, $label, $ik])
            <a href="{{ route($rute) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs($pola) ? 'bg-[#176B36] text-white' : 'text-gray-600 hover:bg-[#E5F5E9] hover:text-[#176B36]' }}">
                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $ikon[$ik] !!}</svg>
                {{ $label }}
            </a>
        @endforeach
    </nav>

    <div class="border-t border-gray-100 p-4">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#E5F5E9] text-[#176B36] font-semibold flex items-center justify-center">
                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <div class="text-sm font-medium text-gray-800 truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-gray-500">{{ $admin ? 'Admin / Pengelola' : 'Nasabah' }}</div>
            </div>
        </div>
        <div class="mt-3 flex gap-2">
            <a href="{{ route('profile.edit') }}" class="flex-1 text-center text-sm py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button class="w-full text-sm py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">Keluar</button>
            </form>
        </div>
    </div>
</aside>