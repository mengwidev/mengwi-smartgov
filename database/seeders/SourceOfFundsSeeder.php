<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SourceOfFunds;

class SourceOfFundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Pendapatan Asli Desa',
            'Dana Desa',
            'Bagi Hasil Pajak dan Retribusi Daerah Kabupaten/Kota',
            'Alokasi Dana Desa',
            'Bantuan Keuangan dari APBD Provinsi',
            'Bantuan Keuangan dari APBD Kabupaten/Kota',
            'Lain-lain Pendapatan Desa yang Sah',
            'Anggaran dan Pendapatan Belanja Desa',
            'Anggaran dan Pendapatan Belanja Daerah Kabupaten/Kota',
            'Anggaran dan Pendapatan Belanja Daerah Provinsi',
            'Anggaran dan Pendapatan Belanja Negara',
            'Bantuan Keuangan Khusus Kabupaten/Kota',
            'Bantuan Keuangan Khusus Provinsi'
        ];

        foreach ($values as $value) {
            $model = SourceOfFunds::firstOrCreate(['name' => $value]);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
