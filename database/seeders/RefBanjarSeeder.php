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
        DB::table('ref_banjar')->insert([
        ['nama_banjar' => 'Batu', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Gambang', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Pande', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Munggu', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Pandean', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Serangan', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Peregae', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Lebah Pangkung', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Pengiasan', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Alangkajeng', 'created_at' => now(), 'updated_at' => now()],
        ['nama_banjar' => 'Delod Bale Agung', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
