<?php

namespace Database\Seeders;

use App\Models\RefMonth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RefMonth::create(['nama_bulan' => 'Januari', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Februari', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Maret', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'April', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Mei', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Juni', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Juli', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Agustus', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'September', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Oktober', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'November', 'created_at' => now(), 'updated_at' => now(),]);
        RefMonth::create(['nama_bulan' => 'Desember', 'created_at' => now(), 'updated_at' => now(),]);
    }
}
