<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transaksi Penyetoran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="p-3 bg-red-100 text-red-800 rounded">{{ $errors->first() }}</div>
            @endif

            <div class="bg-white shadow sm:rounded-lg p-6" x-data="setoran()">
                <h3 class="font-semibold">Catat penyetoran baru</h3>
                <form method="POST" action="{{ route('admin.setoran.store') }}" class="mt-3 space-y-4">
                    @csrf
                    <div class="flex flex-wrap gap-3">
                        <div>
                            <label class="block text-sm font-medium">Nasabah</label>
                            <select name="nasabah_id" required class="border-gray-300 rounded min-w-[260px]">
                                <option value="">Pilih nasabah</option>
                                @foreach ($nasabah as $n)
                                    <option value="{{ $n->id }}" @selected($n->id == $pilih)>{{ $n->kode }} – {{ $n->user->name }} (saldo Rp {{ number_format($n->saldo, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ now()->toDateString() }}" required class="border-gray-300 rounded">
                        </div>
                    </div>

                    <template x-for="(b, i) in baris" :key="i">
                        <div class="flex flex-wrap items-end gap-2">
                            <select :name="'items[' + i + '][jenis_sampah_id]'" x-model="b.jenis_id" required class="border-gray-300 rounded min-w-[240px]">
                                <option value="">Pilih jenis sampah</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama }} (Rp {{ number_format($j->harga, 0, ',', '.') }}/kg)</option>
                                @endforeach
                            </select>
                            <input type="number" step="0.01" min="0.01" :name="'items[' + i + '][berat]'" x-model="b.berat" required placeholder="Berat (kg)" class="border-gray-300 rounded w-32">
                            <span class="w-32 text-right font-medium" x-text="rp(sub(b))"></span>
                            <button type="button" x-show="baris.length > 1" @click="baris.splice(i, 1)" class="text-red-600 text-sm">Hapus baris</button>
                        </div>
                    </template>

                    <button type="button" @click="baris.push({ jenis_id: '', berat: '' })" class="text-green-700 text-sm font-medium">+ Jenis sampah lain</button>

                    <div class="text-lg">Total nilai: <b class="text-green-800" x-text="rp(total)"></b></div>
                    <button class="px-4 py-2 bg-green-700 text-white rounded">Simpan transaksi</button>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Riwayat transaksi</h3>
                <table class="w-full text-sm">
                    <tr class="text-left text-gray-500">
                        <th class="py-2">No.</th><th>Tanggal</th><th>Nasabah</th><th>Jenis</th><th>Berat</th><th>Total</th><th></th>
                    </tr>
                    @forelse ($riwayat as $s)
                        <tr class="border-t">
                            <td class="py-2">TRX-{{ str_pad($s->id, 3, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $s->nasabah->user->name }}</td>
                            <td>{{ $s->detail->pluck('nama_jenis')->join(', ') }}</td>
                            <td>{{ number_format($s->total_berat, 1, ',', '.') }} kg</td>
                            <td>Rp {{ number_format($s->total, 0, ',', '.') }}</td>
                            <td><a href="{{ route('admin.setoran.show', $s) }}" class="text-green-700 font-medium">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-3 text-gray-500">Belum ada transaksi.</td></tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    <script>
        function setoran() {
            return {
                jenis: @js($jenis->map(fn ($j) => ['id' => $j->id, 'harga' => $j->harga])),
                baris: [{ jenis_id: '', berat: '' }],
                sub(b) {
                    const j = this.jenis.find(x => x.id == b.jenis_id);
                    return (j ? j.harga : 0) * (parseFloat(b.berat) || 0);
                },
                get total() {
                    return this.baris.reduce((a, b) => a + this.sub(b), 0);
                },
                rp(n) {
                    return 'Rp ' + Math.round(n).toLocaleString('id-ID');
                },
            };
        }
    </script>
</x-app-layout>
