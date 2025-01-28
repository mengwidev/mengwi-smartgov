<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefEmploymentUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ref_employment_units')->insert([
            'name' => 'Perbekel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Sekretaris Desa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Tata Usaha dan Umum',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Perencanaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Keuangan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Kesejahteraan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Pelayanan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'Pemerintahan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ref_employment_units')->insert([
            'name' => 'BPD',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
