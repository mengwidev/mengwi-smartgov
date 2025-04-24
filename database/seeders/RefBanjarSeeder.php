<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RefBanjar;

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

        foreach ($values as $value) {
            RefBanjar::firstOrCreate([
                'banjar_name' => $value,
            ], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
