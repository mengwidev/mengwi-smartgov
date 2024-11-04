<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefJabatanCommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ref_jabatan_common')->insert([
            ['nama_jabatan' => 'Ketua', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jabatan' => 'Wakil Ketua', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jabatan' => 'Sekretaris', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jabatan' => 'Bendahara', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jabatan' => 'Anggota', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
