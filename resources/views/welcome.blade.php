<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIBERES – {{ config('profil.nama') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        section[id], header[id] { scroll-margin-top: 72px; }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">
@php
    $menu = [
        ['beranda', 'Beranda'], ['profil', 'Profil'], ['layanan', 'Layanan'],
        ['harga', 'Harga Sampah'], ['kegiatan', 'Kegiatan'], ['kontak', 'Kontak'],
    ];
    $ikon = [
        'leaf' => '<path d="M5 19c0-9 5-14 15-14 0 10-5 15-14 15"/><path d="M5 19c3-5 6-8 10-10"/>',
        'coin' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 10c0-1.2 1.3-2 3-2s3 .8 3 2-1.3 2-3 2-3 .8-3 2 1.3 2 3 2 3-.8 3-2"/>',
        'scale' => '<path d="M12 4v16M6 20h12M5 8h14"/><path d="M5 8l-3 7a3 3 0 006 0zM19 8l-3 7a3 3 0 006 0z"/>',
        'truck' => '<path d="M3 6h11v10H3zM14 9h4l3 3v4h-7"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/>',
        'pin' => '<path d="M12 21s7-6 7-11a7 7 0 10-14 0c0 5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
        'phone' => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2z"/>',
        'mail' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
        'clock' => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'check' => '<path d="M5 13l4 4L19 7"/>',
        'refresh' => '<path d="M20 11a8 8 0 00-14-4M4 4v4h4M4 13a8 8 0 0014 4M20 20v-4h-4"/>',
    ];
    $kontak = collect([
        ['pin', 'Alamat', config('profil.alamat')],
        ['phone', 'Telepon / WhatsApp', config('profil.telepon')],
        ['mail', 'Email', config('profil.email')],
        ['clock', 'Jam layanan', config('profil.jam')],
    ])->filter(fn ($k) => filled($k[2]));
@endphp

<nav x-data="{ buka: false, akun: false }" class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        <a href="#beranda"><x-logo :ukuran="44" /></a>

        <div class="hidden lg:flex items-center gap-7 text-sm font-medium">
            @foreach ($menu as [$id, $label])
                <a href="#{{ $id }}" class="text-gray-600 hover:text-[#176B36] transition">{{ $label }}</a>
            @endforeach
        </div>

        <div class="hidden lg:flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-[#176B36] text-white text-sm font-medium hover:opacity-90 transition">Dashboard</a>
            @else
                <div class="relative" @click.outside="akun = false">
                    <button @click="akun = !akun" class="px-4 py-2 rounded-lg border border-[#176B36] text-[#176B36] text-sm font-medium hover:bg-[#E5F5E9] transition inline-flex items-center gap-1">
                        Login
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div x-show="akun" x-cloak class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-1 text-sm">
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-[#E5F5E9]">Login nasabah</a>
                        <a href="{{ route('login.admin') }}" class="block px-4 py-2 hover:bg-[#E5F5E9]">Login admin</a>
                    </div>
                </div>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-[#176B36] text-white text-sm font-medium hover:opacity-90 transition">Daftar</a>
            @endauth
        </div>

        <button @click="buka = !buka" class="lg:hidden p-2 -me-2 rounded-md text-gray-600 hover:bg-gray-100" aria-label="Menu">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </div>

    <div x-show="buka" x-cloak class="lg:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-1 text-sm font-medium">
        @foreach ($menu as [$id, $label])
            <a href="#{{ $id }}" @click="buka = false" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-[#E5F5E9]">{{ $label }}</a>
        @endforeach
        <div class="pt-2 grid gap-2">
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-[#176B36] text-white text-center">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg border border-[#176B36] text-[#176B36] text-center">Login nasabah</a>
                <a href="{{ route('login.admin') }}" class="px-4 py-2 rounded-lg border border-[#176B36] text-[#176B36] text-center">Login admin</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-[#176B36] text-white text-center">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<header id="beranda" class="text-white" style="background:linear-gradient(135deg,#0f4f26,#176B36 60%,#1f8a47)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 grid gap-10 lg:grid-cols-[1.4fr_1fr] items-center">
        <div>
            <span class="inline-block px-3 py-1 rounded-full bg-white/15 text-sm font-medium">{{ config('profil.nama') }}</span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.6rem] font-bold leading-tight tracking-tight">
                Kelola Sampah, Ciptakan Nilai, Wujudkan Lingkungan Berkelanjutan.
            </h1>
            <p class="mt-5 text-green-100 text-lg max-w-xl">
                SIBERES membantu bank sampah mencatat nasabah, harga sampah, setoran, dan saldo tabungan dalam satu sistem yang rapi dan mudah dipakai.
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-lg bg-white text-[#176B36] font-semibold hover:opacity-90 transition">Masuk ke Sistem</a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg bg-white text-[#176B36] font-semibold hover:opacity-90 transition">Masuk ke Sistem</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 rounded-lg border border-white/60 text-white font-semibold hover:bg-white/10 transition">Daftar jadi nasabah</a>
                @endauth
            </div>
        </div>

        <div class="bg-white text-gray-800 rounded-2xl p-6 shadow-2xl"
             x-data="{
                jenis: @js($jenis->map(fn ($j) => ['id' => $j->id, 'nama' => $j->nama, 'harga' => $j->harga])),
                pilih: {{ $jenis->first()->id ?? 'null' }},
                kg: 5,
                get nilai() {
                    const j = this.jenis.find(x => x.id == this.pilih);
                    return (j ? j.harga : 0) * (parseFloat(this.kg) || 0);
                }
             }">
            <h3 class="font-semibold text-lg">Berapa nilai sampahmu?</h3>
            <p class="text-sm text-gray-500">Coba hitung seperti di timbangan bank sampah.</p>

            <label class="block text-sm font-medium mt-4">Jenis sampah</label>
            <select x-model="pilih" class="mt-1 w-full border-gray-300 rounded-lg">
                <template x-for="j in jenis" :key="j.id">
                    <option :value="j.id" x-text="j.nama + ' – Rp ' + j.harga.toLocaleString('id-ID') + '/kg'"></option>
                </template>
            </select>

            <label class="block text-sm font-medium mt-4">Berat (kg)</label>
            <input type="number" min="0" step="0.5" x-model="kg" class="mt-1 w-full border-gray-300 rounded-lg">

            <div class="mt-5 text-sm text-gray-500">Masuk ke tabunganmu</div>
            <div class="text-3xl font-bold text-[#176B36]" x-text="'Rp ' + Math.round(nilai).toLocaleString('id-ID')"></div>
        </div>
    </div>
</header>

@if ($peringkat->isNotEmpty())
@php
    $samar = function ($nama) {
        $b = preg_split('/\s+/', trim($nama));
        return $b[0].(isset($b[1]) ? ' '.mb_strtoupper(mb_substr($b[1], 0, 1)).'.' : '');
    };
    $lencana = ['bg-amber-400 text-white', 'bg-gray-400 text-white', 'bg-orange-400 text-white'];
    $terbanyak = max((float) $peringkat->first()->total_kg, 0.1);
@endphp
<section id="peringkat" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold">Nasabah Teraktif</h2>
        <p class="mt-2 text-gray-500 max-w-2xl">Nasabah dengan total setoran sampah terbanyak. Terima kasih sudah ikut menjaga lingkungan!</p>
        <div class="mt-8 max-w-3xl bg-white border border-gray-200 rounded-2xl divide-y divide-gray-100">
            @foreach ($peringkat as $i => $n)
                <div class="flex items-center gap-4 p-4">
                    <div class="w-9 h-9 shrink-0 rounded-full flex items-center justify-center font-bold {{ $lencana[$i] ?? 'bg-[#E5F5E9] text-[#176B36]' }}">{{ $i + 1 }}</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-baseline justify-between gap-3">
                            <span class="font-semibold truncate">{{ $samar($n->name) }}</span>
                            <span class="font-bold text-[#176B36] whitespace-nowrap">{{ number_format($n->total_kg, 1, ',', '.') }} kg</span>
                        </div>
                        <div class="mt-2 h-2 rounded-full bg-[#E5F5E9] overflow-hidden">
                            <div class="h-full rounded-full bg-[#176B36]" style="width: {{ $n->total_kg / $terbanyak * 100 }}%"></div>
                        </div>
                        <div class="mt-1 text-xs text-gray-500">{{ $n->jumlah }}× setoran</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section id="profil" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 grid gap-10 lg:grid-cols-2 items-center">
        @php
            $extLogo = collect(['png', 'jpg', 'jpeg', 'webp', 'svg'])->first(fn ($e) => file_exists(public_path("images/logo.{$e}"))) ?? 'svg';
        @endphp
        <div class="aspect-[4/3] rounded-2xl shadow-md bg-white border border-gray-100 flex items-center justify-center p-8">
            <img src="{{ asset('images/logo.'.$extLogo) }}" alt="Logo {{ config('profil.nama') }}" class="max-h-80 max-w-full object-contain">
        </div>
        <div>
            <h2 class="text-3xl font-bold">Profil Bank Sampah</h2>
            <p class="mt-1 font-medium text-[#176B36]">{{ config('profil.nama') }}</p>
            <p class="mt-3 text-gray-600">{{ config('profil.profil') }}</p>

            <ul class="mt-5 space-y-3">
                @foreach ([
                    'Menerima setoran sampah dari nasabah.',
                    'Menimbang dan mencatat setoran secara digital.',
                    'Menjemput sampah ke rumah nasabah.',
                    'Saldo tabungan dapat dipantau kapan saja.',
                ] as $teks)
                    <li class="flex gap-3">
                        <span class="mt-0.5 w-6 h-6 shrink-0 rounded-full bg-[#E5F5E9] text-[#176B36] flex items-center justify-center">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">{!! $ikon['check'] !!}</svg>
                        </span>
                        <span class="text-gray-700">{{ $teks }}</span>
                    </li>
                @endforeach
            </ul>

            @if (filled(config('profil.visi')))
                <div class="mt-6 rounded-xl bg-[#E5F5E9] p-4">
                    <div class="text-sm font-semibold text-[#176B36]">Visi</div>
                    <p class="mt-1 text-gray-700">{{ config('profil.visi') }}</p>
                </div>
            @endif
            @if (count(array_filter((array) config('profil.misi'))))
                <div class="mt-4">
                    <div class="text-sm font-semibold text-[#176B36]">Misi</div>
                    <ul class="mt-2 space-y-2">
                        @foreach (array_filter((array) config('profil.misi')) as $m)
                            <li class="flex gap-3 text-gray-700">
                                <svg class="w-5 h-5 shrink-0 text-[#176B36]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">{!! $ikon['check'] !!}</svg>
                                {{ $m }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>

<section id="layanan" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold">Layanan</h2>
        <p class="mt-2 text-gray-500 max-w-2xl">Tiga cara memanfaatkan bank sampah, dari menyetor sampai memantau tabungan.</p>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            @foreach ([
                ['scale', 'Setor langsung', 'Bawa sampah yang sudah dipilah ke bank sampah. Petugas menimbang dan mencatat setoran Anda.'],
                ['truck', 'Dijemput ke rumah', 'Ajukan penjemputan lewat akun nasabah, lalu petugas datang ke alamat Anda.'],
                ['coin', 'Pantau tabungan', 'Nilai setoran dihitung otomatis dari berat dan harga, dan saldo bisa dilihat kapan saja.'],
            ] as [$ik, $judul, $isi])
                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md hover:-translate-y-0.5 transition">
                    <div class="w-12 h-12 rounded-xl bg-[#E5F5E9] text-[#176B36] flex items-center justify-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $ikon[$ik] !!}</svg>
                    </div>
                    <h3 class="mt-4 font-semibold text-lg">{{ $judul }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $isi }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="harga" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold">Jenis dan harga sampah</h2>
        <p class="mt-2 text-gray-500">Daftar harga nasabah {{ config('profil.nama') }}@if ($periodeHarga), {{ $periodeHarga }}@endif. Harga per kilogram.</p>
        <div class="mt-8"><x-daftar-harga :jenis="$jenis" /></div>
        <ul class="mt-4 text-sm text-gray-500 list-disc ps-5 space-y-1">
            <li>Harga disesuaikan saat transaksi dan dapat berubah sewaktu-waktu.</li>
            <li>Untuk hari Sabtu dan Minggu, penjemputan dan penerimaan sampah harap dikonfirmasi terlebih dahulu.</li>
        </ul>
    </div>
</section>

<section id="kegiatan" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold">Kegiatan bank sampah</h2>
        <p class="mt-2 text-gray-500 max-w-2xl">Dari penimbangan sampai penjemputan ke rumah nasabah.</p>
        <div class="mt-8 grid gap-4 sm:grid-cols-3">
            <div class="aspect-[4/3] overflow-hidden rounded-2xl"><x-foto file="kegiatan-1.jpg" alt="Penimbangan sampah di bank sampah" keterangan="Penimbangan sampah" /></div>
            <div class="aspect-[4/3] overflow-hidden rounded-2xl"><x-foto file="kegiatan-2.jpg" alt="Petugas menjemput sampah ke rumah nasabah" keterangan="Penjemputan sampah nasabah" /></div>
            <div class="aspect-[4/3] overflow-hidden rounded-2xl"><x-foto file="kegiatan-3.jpg" alt="Sampah yang sudah dipilah berdasarkan jenis" keterangan="Sampah dipilah per jenis" /></div>
        </div>
    </div>
</section>

<section id="program" class="pb-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h3 class="text-xl font-bold">Program dan kegiatan lainnya</h3>
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['leaf', 'Sosialisasi pengelolaan sampah', 'Edukasi kepada masyarakat tentang cara memilah dan mengelola sampah dari rumah.'],
                ['scale', 'Pelatihan dan pendampingan', 'Pelatihan serta pendampingan untuk pembentukan dan pengelolaan bank sampah.'],
                ['coin', 'Pertemuan dan apresiasi', 'Pertemuan para pengelola bank sampah, serta apresiasi untuk bank sampah unit dan nasabah terbaik.'],
                ['refresh', 'Pengolahan sampah', 'Sampah organik diolah menjadi pakan maggot, sampah anorganik dijadikan kerajinan atau dijual ke pengepul.'],
            ] as [$ik, $judul, $isi])
                <div class="bg-white border border-gray-200 rounded-xl p-5 hover:shadow-md hover:-translate-y-0.5 transition">
                    <div class="w-11 h-11 rounded-xl bg-[#E5F5E9] text-[#176B36] flex items-center justify-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $ikon[$ik] !!}</svg>
                    </div>
                    <h4 class="mt-4 font-semibold">{{ $judul }}</h4>
                    <p class="mt-1 text-sm text-gray-500">{{ $isi }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="kontak" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <h2 class="text-3xl font-bold">Kontak</h2>
        <p class="mt-2 text-gray-500">Hubungi pengelola bank sampah untuk informasi lebih lanjut.</p>
        @php
            $tel = preg_replace('/\D+/', '', (string) config('profil.telepon'));
            $wa = $tel ? '62'.ltrim($tel, '0') : null;
            $ig = ltrim((string) config('profil.instagram'), '@');
            $ikonIg = '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/>';
            $daftarKontak = collect([
                ['phone', 'Telepon / WhatsApp', config('profil.telepon'), $wa ? 'https://wa.me/'.$wa : null],
                ['mail', 'Email', config('profil.email'), config('profil.email') ? 'mailto:'.config('profil.email') : null],
                ['insta', 'Instagram', $ig ? '@'.$ig : null, $ig ? 'https://instagram.com/'.$ig : null],
                ['pin', 'Alamat', config('profil.alamat'), null],
                ['clock', 'Jam layanan', config('profil.jam'), null],
            ])->filter(fn ($k) => filled($k[2]));
        @endphp
        <div class="mt-8 border border-gray-200 rounded-2xl p-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($daftarKontak as [$ik, $judul, $isi, $tautan])
                <div class="flex gap-4">
                    <div class="w-11 h-11 shrink-0 rounded-xl bg-[#E5F5E9] text-[#176B36] flex items-center justify-center">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $ik === 'insta' ? $ikonIg : $ikon[$ik] !!}</svg>
                    </div>
                    <div class="min-w-0">
                        <div class="text-sm text-gray-500">{{ $judul }}</div>
                        @if ($tautan)
                            <a href="{{ $tautan }}" target="_blank" rel="noopener" class="font-medium text-[#176B36] hover:underline break-words">{{ $isi }}</a>
                        @else
                            <div class="font-medium break-words">{{ $isi }}</div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Informasi kontak akan segera tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

<footer class="bg-[#10351d] text-green-100 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 grid gap-8 sm:grid-cols-3">
        <div>
            <x-logo :putih="true" :ukuran="44" />
            <p class="mt-3 text-green-200/80">{{ config('profil.tagline') }}</p>
        </div>
        <div>
            <div class="font-semibold text-white mb-2">Menu</div>
            <div class="grid gap-1">
                @foreach ($menu as [$id, $label])
                    <a href="#{{ $id }}" class="hover:text-white">{{ $label }}</a>
                @endforeach
            </div>
        </div>
        <div>
            <div class="font-semibold text-white mb-2">Akun</div>
            <div class="grid gap-1">
                <a href="{{ route('login') }}" class="hover:text-white">Login nasabah</a>
                <a href="{{ route('login.admin') }}" class="hover:text-white">Login admin</a>
                <a href="{{ route('register') }}" class="hover:text-white">Daftar nasabah</a>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-4 text-center text-green-200/70">© {{ date('Y') }} SIBERES – {{ config('profil.nama') }}</div>
</footer>
</body>
</html>