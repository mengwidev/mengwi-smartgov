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
        //Insert Last Education values
        DB::table('ref_last_education')->insert(['name' => 'TIDAK/BELUM SEKOLAH', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'BELUM TAMAT SD/SEDERAJAT', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'TAMAT SD/SEDERAJAT', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'SLTP/SEDERAJAT', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'SLTA/SEDERAJAT', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'AKADEMI/ DIPLOMA III/S. MUDA', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'DIPLOMA IV/STRATA I', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'STRATA II', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_last_education')->insert(['name' => 'STRATA III', 'created_at' => now(), 'updated_at' => now()]);
    }
}
