@props(['jenis'])
@php
    $urut = ['Kertas', 'Logam', 'Logam Mulia', 'Kaca', 'Plastik', 'Lainnya'];
    $data = $jenis->map(fn ($j) => [
        'nama' => $j->nama,
        'harga' => (int) $j->harga,
        'kat' => $j->kategori ?: 'Lainnya',
        'ket' => $j->keterangan,
    ])->values();
    $kategori = $data->pluck('kat')->unique()
        ->sortBy(fn ($k) => ($i = array_search($k, $urut)) === false ? 99 : $i)->values();
@endphp
<div x-data="{
        q: '',
        kat: 'Semua',
        data: @js($data),
        get hasil() {
            const q = this.q.trim().toLowerCase();
            return this.data.filter(d =>
                (this.kat === 'Semua' || d.kat === this.kat) &&
                (q === '' || d.nama.toLowerCase().includes(q) || (d.ket || '').toLowerCase().includes(q)));
        }
     }">
    <div class="flex flex-wrap items-center gap-2">
        <button type="button" @click="kat = 'Semua'"
                :class="kat === 'Semua' ? 'bg-[#176B36] text-white border-[#176B36]' : 'bg-white text-gray-700 border-gray-300 hover:border-[#176B36]'"
                class="px-3 py-1.5 rounded-full border text-sm font-medium transition">Semua</button>
        @foreach ($kategori as $k)
            <button type="button" @click="kat = '{{ $k }}'"
                    :class="kat === '{{ $k }}' ? 'bg-[#176B36] text-white border-[#176B36]' : 'bg-white text-gray-700 border-gray-300 hover:border-[#176B36]'"
                    class="px-3 py-1.5 rounded-full border text-sm font-medium transition">{{ $k }}</button>
        @endforeach
        <input type="search" x-model="q" placeholder="Cari jenis sampah..." class="sm:ms-auto w-full sm:w-64 border-gray-300 rounded-lg text-sm">
    </div>

    <div class="mt-4 border border-gray-200 rounded-2xl overflow-hidden bg-white">
        <div class="max-h-[30rem] overflow-y-auto">
            <table class="w-full text-sm">
                <thead class="sticky top-0 bg-[#E5F5E9] text-[#176B36] text-left">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Jenis sampah</th>
                        <th class="px-4 py-3 font-semibold hidden sm:table-cell">Keterangan</th>
                        <th class="px-4 py-3 font-semibold text-right whitespace-nowrap">Harga / kg</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="d in hasil" :key="d.nama">
                        <tr class="border-t border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-2.5">
                                <div class="font-medium" x-text="d.nama"></div>
                                <div class="sm:hidden text-xs text-gray-500" x-text="d.ket"></div>
                            </td>
                            <td class="px-4 py-2.5 text-gray-500 hidden sm:table-cell" x-text="d.ket || '-'"></td>
                            <td class="px-4 py-2.5 text-right font-semibold text-[#176B36] whitespace-nowrap" x-text="'Rp ' + d.harga.toLocaleString('id-ID')"></td>
                        </tr>
                    </template>
                    <tr x-show="hasil.length === 0">
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">Tidak ada jenis sampah yang cocok.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <p class="mt-2 text-xs text-gray-500" x-text="hasil.length + ' dari ' + data.length + ' jenis ditampilkan'"></p>
</div>