<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIBERES') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none !important} body{font-family:'Inter',ui-sans-serif,system-ui,sans-serif}</style>
</head>
<body class="antialiased bg-gray-100">
    <div x-data="{ open: false }" class="min-h-screen lg:flex">
        <div x-show="open" x-cloak @click="open = false" class="fixed inset-0 z-30 bg-black/40 lg:hidden"></div>

        @include('layouts.navigation')

        <div class="flex-1 min-w-0 flex flex-col">
            <div class="lg:hidden sticky top-0 z-20 bg-white border-b border-gray-200 h-14 px-4 flex items-center gap-3">
                <button @click="open = true" aria-label="Buka menu" class="p-2 -ms-2 rounded-md text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <span class="font-bold text-[#176B36]">SIBERES</span>
            </div>

            @isset($header)
                <header class="bg-white border-b border-gray-200">
                    <div class="px-4 sm:px-6 lg:px-8 py-5">{{ $header }}</div>
                </header>
            @endisset

            <main class="flex-1">{{ $slot }}</main>
        </div>
    </div>
</body>
</html>