@props(['peran' => 'nasabah', 'gambar' => 'kegiatan-2.jpg'])
@php
    $admin = $peran === 'admin';
    $latar = $admin
        ? 'linear-gradient(135deg,#0a2e17,#10451f 60%,#176B36)'
        : 'linear-gradient(135deg,#0f4f26,#176B36 60%,#1f8a47)';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIBERES') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }</style>
</head>
<body class="antialiased text-gray-900">
    <div class="min-h-screen lg:grid lg:grid-cols-2">
        <div class="hidden lg:flex flex-col justify-between p-10 text-white" style="background: {{ $latar }}">
            <a href="/"><x-logo :putih="true" :ukuran="44" /></a>
            <div>
                <div class="aspect-[4/3] max-w-md rounded-2xl overflow-hidden shadow-2xl">
                    <x-foto :file="$gambar" />
                </div>
                <h2 class="mt-8 text-3xl font-bold leading-tight">
                    {{ $admin ? 'Kelola bank sampah dengan rapi.' : 'Pantau tabungan sampahmu.' }}
                </h2>
                <p class="mt-2 text-green-100 max-w-md">
                    {{ $admin
                        ? 'Catat setoran, atur harga, verifikasi nasabah, dan lihat laporan dalam satu tempat.'
                        : 'Lihat saldo, riwayat setoran, dan minta penjemputan sampah kapan saja.' }}
                </p>
            </div>
            <div class="text-sm text-green-200/80">SIBERES – {{ config('profil.nama') }}</div>
        </div>

        <div class="flex flex-col items-center justify-center px-6 py-10 bg-white">
            <div class="lg:hidden mb-6"><a href="/"><x-logo :ukuran="40" /></a></div>
            <div class="w-full max-w-md">{{ $slot }}</div>
            <a href="/" class="mt-8 text-sm text-gray-500 hover:text-[#176B36]">← Kembali ke beranda</a>
        </div>
    </div>
</body>
</html>