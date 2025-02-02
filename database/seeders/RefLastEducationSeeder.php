<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        //Insert Last Education values
        foreach ($values as $value) {
            DB::table('ref_last_education')->insert([
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
