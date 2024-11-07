<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CfgKaderBankSampah;

class CfgKaderBankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CfgKaderBankSampah::truncate();

        CfgKaderBankSampah::create([
            'bank_sampah_name' => 'Yoga Mesari',
            'kd_count_bt' => 5,
            'kd_count_gb' => 5,
            'kd_count_pd' => 6,
            'kd_count_mg' => 5,
            'kd_count_pdn' => 2,
            'kd_count_srg' => 5,
            'kd_count_prg' => 5,
            'kd_count_lp' => 5,
            'kd_count_pg' => 5,
            'kd_count_al' => 5,
            'kd_count_dba' => 7,
            'honor' => 100000,
            'tax' => 5,
        ]);
    }
}
