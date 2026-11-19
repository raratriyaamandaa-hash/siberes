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
<body class="text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8 bg-[#E5F5E9]">
        <a href="/"><x-logo :ukuran="40" /></a>

        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md rounded-xl">
            {{ $slot }}
        </div>

        <a href="/" class="mt-5 text-sm text-gray-600 hover:text-[#176B36]">← Kembali ke beranda</a>
    </div>
</body>
</html>