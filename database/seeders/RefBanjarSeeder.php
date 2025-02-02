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
        $values = [
            'Batu',
            'Gambang',
            'Pande',
            'Munggu',
            'Pandean',
            'Serangan',
            'Peregae',
            'Lebah Pangkung',
            'Pengiasan',
            'Alangkajeng',
            'Delod Bale Agung',
        ];

        //Insert Ref Banjar Values
        foreach ($values as $value) {
            DB::table('ref_banjar')->insert([
                'banjar_name' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
