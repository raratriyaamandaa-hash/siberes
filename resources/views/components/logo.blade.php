@props(['putih' => false, 'ukuran' => 40])
@php
    $ext = collect(['png', 'jpg', 'jpeg', 'webp', 'svg'])->first(fn ($e) => file_exists(public_path("images/logo.{$e}"))) ?? 'svg';
    $kustom = $ext !== 'svg';
@endphp
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5']) }}>
    <img src="{{ asset('images/logo.'.$ext) }}" alt="Logo {{ config('profil.nama') }}"
         class="object-contain {{ $putih && $kustom ? 'bg-white rounded-lg p-0.5' : '' }}"
         style="height: {{ $ukuran }}px; width: auto; max-width: {{ round($ukuran * 1.4) }}px">
    <span class="leading-tight">
        <span class="block font-bold text-lg {{ $putih ? 'text-white' : 'text-[#176B36]' }}">SIBERES</span>
        <span class="block text-[10px] font-medium {{ $putih ? 'text-green-100' : 'text-gray-500' }}">{{ config('profil.nama') }}</span>
    </span>
</span>