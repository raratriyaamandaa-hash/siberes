<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jenis dan Harga Sampah</h2>
    </x-slot>

    @php
        $urut = ['Kertas', 'Logam', 'Logam Mulia', 'Kaca', 'Plastik'];
        $indeks = fn ($j) => (($i = array_search($j->kategori ?: 'Lainnya', $urut)) === false ? 99 : $i) * 100000 + $j->id;
        $baris = $daftar->sortBy($indeks)->values();
        $kategori = $baris->map(fn ($j) => $j->kategori ?: 'Lainnya')->unique()->values();
        $awal = $daftar->mapWithKeys(fn ($j) => [$j->id => (int) $j->harga]);
    @endphp

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="font-semibold mb-3">Tambah jenis sampah</h3>
                <form method="POST" action="{{ route('admin.jenis-sampah.store') }}" class="grid gap-3 sm:grid-cols-2 lg:grid-cols-[2fr_1.2fr_1fr_2fr_auto] items-end">
                    @csrf
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Nama jenis</label>
                        <input name="nama" required class="w-full border-gray-300 rounded-md" placeholder="Nama jenis">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Kategori</label>
                        <input name="kategori" list="daftar-kategori" class="w-full border-gray-300 rounded-md" placeholder="mis. Plastik">
                        <datalist id="daftar-kategori">
                            @foreach ($kategori as $k)
                                <option value="{{ $k }}">
                            @endforeach
                        </datalist>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Harga / kg (Rp)</label>
                        <input name="harga" type="number" min="0" required class="w-full border-gray-300 rounded-md" placeholder="0">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Keterangan (opsional)</label>
                        <input name="keterangan" class="w-full border-gray-300 rounded-md" placeholder="mis. bersih dan kering">
                    </div>
                    <button class="px-4 py-2 rounded-md bg-[#176B36] text-white font-medium hover:opacity-90">Tambah</button>
                </form>
            </div>

            <form method="POST" action="{{ route('admin.jenis-sampah.harga') }}"
                  class="bg-white shadow sm:rounded-lg p-6"
                  x-data="{
                      awal: @js($awal),
                      baru: @js($awal),
                      periodeAwal: @js((string) $periode),
                      periode: @js((string) $periode),
                      q: '',
                      kat: 'Semua',
                      tampil(k, n) { return (this.kat === 'Semua' || this.kat === k) && (this.q.trim() === '' || n.includes(this.q.trim().toLowerCase())); },
                      berubah(id) { return Number(this.baru[id]) !== this.awal[id]; },
                      get jumlah() { return Object.keys(this.awal).filter(id => this.berubah(id)).length; }
                  }">
                @csrf

                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <h3 class="font-semibold">Perbarui harga</h3>
                        <p class="text-sm text-gray-500">
                            Ubah harga yang berganti, lalu simpan sekaligus.
                            @if ($terakhir) Terakhir diubah {{ $terakhir->format('d/m/Y H:i') }}. @endif
                        </p>
                    </div>
                    <div class="w-full sm:w-72">
                        <label class="block text-xs text-gray-500 mb-1">Periode harga (tampil di halaman depan)</label>
                        <input name="periode" x-model="periode" maxlength="60" class="w-full border-gray-300 rounded-md" placeholder="mis. 1-14 Desember 2026">
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <button type="button" @click="kat = 'Semua'"
                            :class="kat === 'Semua' ? 'bg-[#176B36] text-white border-[#176B36]' : 'bg-white text-gray-700 border-gray-300 hover:border-[#176B36]'"
                            class="px-3 py-1.5 rounded-full border text-sm font-medium transition">Semua</button>
                    @foreach ($kategori as $k)
                        <button type="button" @click="kat = @js($k)"
                                :class="kat === @js($k) ? 'bg-[#176B36] text-white border-[#176B36]' : 'bg-white text-gray-700 border-gray-300 hover:border-[#176B36]'"
                                class="px-3 py-1.5 rounded-full border text-sm font-medium transition">{{ $k }}</button>
                    @endforeach
                    <input type="search" x-model="q" placeholder="Cari jenis sampah..." class="sm:ms-auto w-full sm:w-64 border-gray-300 rounded-md text-sm">
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b border-gray-200">
                                <th class="py-2 pe-3 font-medium">Jenis sampah</th>
                                <th class="py-2 pe-3 font-medium hidden md:table-cell">Kategori</th>
                                <th class="py-2 pe-3 font-medium text-right">Harga / kg</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($baris as $j)
                                <tr class="border-b border-gray-100"
                                    :class="berubah({{ $j->id }}) ? 'bg-amber-50' : ''"
                                    x-show="tampil(@js($j->kategori ?: 'Lainnya'), @js(mb_strtolower($j->nama.' '.$j->keterangan)))">
                                    <td class="py-2 pe-3">
                                        <div class="font-medium">{{ $j->nama }}</div>
                                        @if ($j->keterangan)
                                            <div class="text-xs text-gray-500">{{ $j->keterangan }}</div>
                                        @endif
                                    </td>
                                    <td class="py-2 pe-3 text-gray-500 hidden md:table-cell">{{ $j->kategori ?: 'Lainnya' }}</td>
                                    <td class="py-2 pe-3">
                                        <div class="flex items-center justify-end gap-2">
                                            <span class="text-gray-500">Rp</span>
                                            <input type="number" min="0" step="1" name="harga[{{ $j->id }}]" x-model="baru[{{ $j->id }}]"
                                                   class="w-28 border-gray-300 rounded-md text-right">
                                        </div>
                                        <div x-show="berubah({{ $j->id }})" x-cloak class="text-xs text-amber-700 text-right mt-0.5">
                                            sebelumnya Rp {{ number_format($j->harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="py-2 text-right">
                                        <button type="submit" form="hapus-{{ $j->id }}"
                                                onclick="return confirm('Hapus jenis sampah ini? Riwayat transaksi lama tidak ikut terhapus.')"
                                                class="px-2.5 py-1 rounded-md border border-red-300 text-red-600 hover:bg-red-50 text-xs font-medium">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="sticky bottom-0 -mx-6 -mb-6 mt-2 px-6 py-3 bg-white/95 backdrop-blur border-t border-gray-200 rounded-b-lg flex flex-wrap items-center justify-between gap-3">
                    <div class="text-sm"
                         :class="(jumlah || periode !== periodeAwal) ? 'text-amber-700 font-medium' : 'text-gray-500'"
                         x-text="jumlah ? (jumlah + ' harga diubah, belum disimpan') : (periode !== periodeAwal ? 'Periode diubah, belum disimpan' : 'Belum ada perubahan')"></div>
                    <button :disabled="jumlah === 0 && periode === periodeAwal"
                            class="px-4 py-2 rounded-lg bg-[#176B36] text-white font-medium hover:opacity-90 disabled:opacity-40 disabled:cursor-not-allowed">
                        Simpan semua perubahan
                    </button>
                </div>
            </form>

            <p class="text-xs text-gray-500">Perubahan harga hanya berlaku untuk transaksi baru. Transaksi lama tetap memakai harga saat dicatat.</p>

            @foreach ($daftar as $j)
                <form id="hapus-{{ $j->id }}" method="POST" action="{{ route('admin.jenis-sampah.destroy', $j) }}" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>
    </div>
</x-app-layout>