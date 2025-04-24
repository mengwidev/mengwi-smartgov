<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RefEmploymentUnits;

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
            RefEmploymentUnits::firstOrCreate(
                ['name' => $value],
                [
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
