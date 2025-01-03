<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefBanjarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert Ref Banjar Values
        DB::table('ref_banjar')->insert(['banjar_name' => 'Batu', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Gambang', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Pande', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Munggu', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Pandean', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Serangan', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Peregae', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Lebah Pangkung', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Pengiasan', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Alangkajeng', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_banjar')->insert(['banjar_name' => 'Delod Bale Agung', 'created_at' => now(), 'updated_at' => now()]);
    }
}
