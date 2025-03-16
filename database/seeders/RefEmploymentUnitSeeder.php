<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefEmploymentUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Perbekel',
            'Sekretaris Desa',
            'Tata Usaha dan Umum',
            'Perencanaan',
            'Keuangan',
            'Kesejahteraan',
            'Pemerintahan',
            'Pelayanan',
            'BPD',
        ];

        foreach ($values as $value) {
            DB::table('ref_employment_units')->insert([
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
