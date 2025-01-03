<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert Ref Month values
        DB::table('ref_month')->insert(['name' => 'Januari', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Februari', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Maret', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'April', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Mei', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Juni', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Juli', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Agustus', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'September', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Oktober', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'November', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_month')->insert(['name' => 'Desember', 'created_at' => now(), 'updated_at' => now()]);
    }
}
