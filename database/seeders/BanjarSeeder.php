<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banjar;

class BanjarSeeder extends Seeder
{
    public function run(): void
    {
        $banjars = [
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

        foreach ($banjars as $name) {
            $model = Banjar::firstOrCreate(['name' => $name]);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
