<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['Plastik PET (botol)', 3500],
            ['Keras & Kardus', 1800],
            ['Kaleng aluminium', 9000],
            ['Botol kaca', 700],
            ['Logam & Besi', 3000],
        ];

        foreach ($data as [$nama, $harga]) {
            \App\Models\JenisSampah::create(['nama' => $nama, 'harga' => $harga]);
        }
    }
}
