<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RefLastEducation;

class RefLastEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $values = [
            'TIDAK/BELUM SEKOLAH',
            'BELUM TAMAT SD/SEDERAJAT',
            'TAMAT SD/SEDERAJAT',
            'SLTP/SEDERAJAT',
            'SLTA/SEDERAJAT',
            'AKADEMI/ DIPLOMA III/S. MUDA',
            'DIPLOMA IV/STRATA I',
            'STRATA II',
            'STRATA III',
        ];

        foreach ($values as $value) {
            RefLastEducation::firstOrCreate(
                ['name' => $value],
                [
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
