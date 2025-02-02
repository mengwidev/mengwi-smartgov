<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategoryModel as ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Alat Tulis Kantor dan Benda Pos'],
            ['name' => 'Perlengkapan Alat-alat Listrik'],
            ['name' => 'Perlengkapan Alat Rumah Tangga dan Bahan Kebersihan'],
            [
                'name' =>
                    'Bahan Bakar Minyak/Gas/Isi Ulang Tabung Pemadam Kebakaran',
            ],
            ['name' => 'Barang Cetak dan Penggandaan'],
            ['name' => 'Barang Konsumsi (Makan/Minum)'],
            ['name' => 'Obat-Obatan'],
            ['name' => 'Aci-aci Banten'],
            ['name' => 'Prasarana Upakara/Keagamaan'],
            ['name' => 'Fotokopi dan Penjilidan'],
        ];

        foreach ($values as $value) {
            ProductCategory::create([
                'name' => $value['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
