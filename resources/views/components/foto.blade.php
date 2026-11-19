@props(['file', 'alt' => '', 'keterangan' => null, 'posisi' => 'center'])
@php
    $dasar = pathinfo($file, PATHINFO_FILENAME);
    $temu = null;
    foreach (['jpg', 'jpeg', 'png', 'webp', 'svg'] as $ext) {
        if (file_exists(public_path("images/{$dasar}.{$ext}"))) {
            $temu = "images/{$dasar}.{$ext}";
            break;
        }
    }
    $svg = $temu && str_ends_with($temu, '.svg');
@endphp
@if ($temu && $keterangan && ! $svg)
    <div class="w-full h-full flex flex-col" style="container-type: inline-size">
        <div class="relative" style="height: 78.67%">
            <img src="{{ asset($temu) }}" alt="{{ $alt }}" loading="lazy" class="absolute inset-0 w-full h-full object-cover" style="object-position: {{ $posisi }}">
        </div>
        <div class="flex items-center justify-center" style="height: 21.33%; background: #bfe3c9">
            <span class="font-semibold" style="font-size: 4cqw; color: #176B36">{{ $keterangan }}</span>
        </div>
    </div>
@elseif ($temu)
    <img src="{{ asset($temu) }}" alt="{{ $alt }}" loading="lazy" class="w-full h-full object-cover" style="object-position: {{ $posisi }}">
@else
    <div class="w-full h-full flex items-center justify-center" style="background:linear-gradient(135deg,#E5F5E9,#bfe3c9)">
        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#176B36" stroke-opacity=".45" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 19c0-9 5-14 15-14 0 10-5 15-14 15"/><path d="M5 19c3-5 6-8 10-10"/></svg>
    </div>
@endif