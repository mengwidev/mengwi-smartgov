<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaderBankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kader_bank_sampah')->insert([
        [
            'nama' => 'NI WAYAN JUNI ANTARI',
            'jabatan_id' => "1",
            'banjar_id' => "1",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'AGUNG AYU PUTU MULIASIH',
            'jabatan_id' => "5",
            'banjar_id' => "1",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI KADEK KASNI',
            'jabatan_id' => "5",
            'banjar_id' => "1",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI PUTU PUSPARINI',
            'jabatan_id' => "5",
            'banjar_id' => "1",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI GUSTI AYU MURTIANI',
            'jabatan_id' => "5",
            'banjar_id' => "1",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI MADE SARIASIH',
            'jabatan_id' => "1",
            'banjar_id' => "2",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI MADE SRI ARYATI',
            'jabatan_id' => "5",
            'banjar_id' => "2",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI NYOMAN SURNIASIH',
            'jabatan_id' => "5",
            'banjar_id' => "2",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI LUH TONIASIH',
            'jabatan_id' => "5",
            'banjar_id' => "2",
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'NI PUTU SANTIANI',
            'jabatan_id' => "5",
            'banjar_id' => "2",
            'created_at' => now(),
            'updated_at' => now()
        ],
        ]);
    }
}
