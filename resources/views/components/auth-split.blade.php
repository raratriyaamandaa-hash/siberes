@props(['peran' => 'nasabah', 'gambar' => null])
@php
    $admin = $peran === 'admin';
    $latar = $admin ? 'linear-gradient(135deg,#0a2e17,#10451f 55%,#176B36)' : '#E5F5E9';
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
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10" style="background: {{ $latar }}">
        <a href="/"><x-logo :putih="$admin" :ukuran="52" /></a>

        <div class="w-full max-w-md mt-6 bg-white rounded-2xl px-6 sm:px-8 py-8" style="box-shadow: 0 20px 40px rgba(0,0,0,.18)">
            {{ $slot }}
        </div>

        <a href="/" class="mt-6 text-sm {{ $admin ? 'text-green-100 hover:text-white' : 'text-gray-600 hover:text-[#176B36]' }}">← Kembali ke beranda</a>
    </div>
</body>
</html>