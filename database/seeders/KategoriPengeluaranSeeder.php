<?php

namespace Database\Seeders;

use App\Models\KategoriPengeluaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Listrik'],
            ['nama_kategori' => 'Air'],
            ['nama_kategori' => 'Internet'],
            ['nama_kategori' => 'Transportasi'],
            ['nama_kategori' => 'Konsumsi']
        ];

        foreach ($data as $item) {
            KategoriPengeluaran::firstOrCreate([
                'nama_kategori' => $item['nama_kategori']
            ]);
        }
    }
}
