<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefSatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ref_satuan')->insert([
            ['nama_satuan' => 'kg', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'gr', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'mg', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'cm', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'm', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'km', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'pcs', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'paket', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'l', 'created_at' => now(), 'updated_at' => now()],
            ['nama_satuan' => 'ml', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
