<?php

namespace Database\Seeders;

use App\Models\JenisSampah;
use Illuminate\Database\Seeder;

class HargaSampahSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar harga nasabah Bank Sampah Induk New Normal, November 2026 (harga per kg).
        // Format: [nama, harga, kategori, keterangan]
        $data = [
            ['Karton (tersusun rapi dan diikat)', 2000, 'Kertas', 'Kertas berpori sudah tersusun rapi dan diikat'],
            ['Karton (tidak tersusun rapi)', 1900, 'Kertas', 'Kertas berpori tidak tersusun rapi'],
            ['Dupleks', 400, 'Kertas', 'Licin tidak berpori, sampul, sarang telur'],
            ['Buku', 600, 'Kertas', 'Buku bekas, kertas ubi, HVS warna, kertas bon. Kertas hancur'],
            ['HVS', 1800, 'Kertas', 'HVS warna putih dengan tinta hitam, double folio'],
            ['Koran Bagus', 5000, 'Kertas', 'Semua jenis koran yang masih bagus'],

            ['Seng', 2000, 'Logam', 'Semua jenis seng, kawat springbed'],
            ['Kabin', 3000, 'Logam', 'Campuran aluminium dan besi, contoh: kipas angin, rice cooker, radio, dandang, baja ringan, payung, kuali'],
            ['Kaleng', 2000, 'Logam', 'Kaleng yang tidak bisa diremukkan'],
            ['Besi Sam-Sam', 2500, 'Logam', 'Termasuk kawat kalender'],
            ['Besi Batang', 3500, 'Logam', 'Termasuk besi sepeda, troli bayi'],
            ['Besi Padu', 4000, 'Logam', 'Besi padat, kipas angin'],

            ['Aluminium ACC', 25000, 'Logam Mulia', 'Bisa diremukkan dan tidak berkarat'],
            ['Aluminium Panci', 28000, 'Logam Mulia', 'Termasuk panci dalam rice cooker'],
            ['Aluminium Mesin (bersih)', 16000, 'Logam Mulia', 'Aluminium mesin dalam keadaan bersih'],
            ['Aluminium Mesin (kotor)', 5000, 'Logam Mulia', 'Aluminium mesin dalam keadaan kotor'],
            ['Aluminium Priuk', 15000, 'Logam Mulia', null],
            ['Kuningan', 90000, 'Logam Mulia', null],
            ['Babet', 10000, 'Logam Mulia', 'Contoh: tungku kompor gas, dinamo'],
            ['Tembaga', 180000, 'Logam Mulia', null],
            ['Timah', 17000, 'Logam Mulia', null],

            ['Kaca Bening Pecah', 150, 'Kaca', null],
            ['Kaca Botol Pecah', 150, 'Kaca', null],
            ['Kaca Pecah Campur', 150, 'Kaca', null],
            ['Kaca Datar Bening', 150, 'Kaca', 'Contoh: kaca meja, kaca nako'],
            ['Kaca Datar Hitam', 150, 'Kaca', null],

            ['PP Cup Bening (Cup Super)', 6500, 'Plastik', 'Tanpa penutup dan label'],
            ['PP Cup Bening (Cup Kotor)', 3000, 'Plastik', 'Masih ada tutup dan label'],
            ['PP Cup Gelas Mambo', 2000, 'Plastik', 'Cup tanpa tutup, bersablon'],
            ['PP Cup Warna', 2000, 'Plastik', 'Montea, Ale-ale, dan sejenisnya'],
            ['PET Bening Biru Bersih (Mix)', 5000, 'Plastik', 'Campuran botol bening dan biru yang sudah bersih'],
            ['PET Warna', 800, 'Plastik', 'Mizone, Sprite, dan sejenisnya'],
            ['PET Kotor', 1500, 'Plastik', 'Masih bertutup dan berlabel'],
            ['PET Bening Biru Bersih Campur Warna', 2000, 'Plastik', 'Botol bening, biru, dan warna, semuanya sudah bersih'],
            ['PET Putih', 800, 'Plastik', 'Botol minuman susu putih'],
            ['PET Cong', 1000, 'Plastik', 'PET bening + BM + kecap/saus + PET berlabel'],
            ['PET Campur-campur', 500, 'Plastik', 'Campuran botol, cup, sachet, asoi, ember botol, ember warna'],
            ['PET Non Botol (Empek Botol)', 500, 'Plastik', 'Botol kecap, saus, yakult, dan sejenisnya'],
            ['HDPE Ember Warna', 2000, 'Plastik', 'Termasuk tutup botol'],
            ['HDPE Ember Hitam', 1000, 'Plastik', 'Termasuk cong, dispenser, ember merah marun'],
            ['HDPE Ember Botol', 3000, 'Plastik', 'Botol, tutup Aqua, botol oli, botol bedak, tube, dan sejenisnya'],
            ['HDPE Ember Bening', 3700, 'Plastik', 'Contoh: box makanan bening'],
            ['HDPE Daunan (Plastik HD/putih)', 3500, 'Plastik', 'Plastik gula yang tidak bening/keruh'],
            ['LDPE Daunan (Asoi Bersih)', 1000, 'Plastik', 'Kantong tipis semua warna, bersih, kering, dikoyak'],
            ['PP Bentukan (Pipet)', 2000, 'Plastik', 'Meja plastik, kursi plastik, pipet, piring plastik'],
            ['PP Tutup Galon', 6000, 'Plastik', 'Tutup galon air mineral/air isi ulang'],
            ['PP Kresek Bersih', 1000, 'Plastik', 'Bungkus baju, bersuara kresek saat diremas, bening, bersih, bubble hitam'],
            ['PP Kresek Kotor', 500, 'Plastik', 'Kotor, bertanah, berdebu, dan tidak dikoyak'],
            ['PP Tenun Karung Utuh', 1000, 'Plastik', 'Karung plastik utuh ukuran 5, 10, 30, 50 kg, dan seterusnya'],
            ['PP Tenun Karung Koyak', 500, 'Plastik', 'Potongan karung, karung koyak dan kotor bertanah'],
            ['PE Bening Bersih (Sam-sam)', 3500, 'Plastik', 'Bening, bersih, dicuci, kering, dikoyak, bubble putih, plastik bening'],
            ['PE Bening Kotor', 2000, 'Plastik', 'Kotor dan tidak dikoyak'],
            ['PE Warna/Sablon Bersih', 1000, 'Plastik', 'Trash bag, polibag dicuci, dikoyak dan kering, plastik bening bercap'],
            ['PE Warna/Sablon Kotor', 500, 'Plastik', 'Trash bag, polibag kotor, plastik bihun'],
            ['CD Komputer', 4000, 'Plastik', null],
            ['SAN Galon Le Mineral/Cleo', 3000, 'Plastik', null],
            ['PVC', 500, 'Plastik', 'Pipa PVC, paralon'],
            ['Empek Kerasan (Empek Cong)', 400, 'Plastik', 'Toples kue bening, rak dalaman kulkas, helm, tabung blender, bersuara nyaring. Koper termasuk empek'],
            ['Plastik Cong (Jenis Lain)', 500, 'Plastik', 'Plastik campur'],
        ];

        // Hapus jenis contoh bawaan. Riwayat transaksi lama tetap aman karena
        // nama dan harga sudah tersalin di tiap transaksi.
        JenisSampah::whereIn('nama', [
            'Plastik PET (botol)', 'Kertas & kardus', 'Kaleng aluminium',
            'Botol kaca', 'Logam & besi', 'Minyak jelantah',
        ])->delete();

        foreach ($data as [$nama, $harga, $kategori, $keterangan]) {
            JenisSampah::updateOrCreate(
                ['nama' => $nama],
                ['harga' => $harga, 'kategori' => $kategori, 'keterangan' => $keterangan]
            );
        }
    }
}