<?php

namespace Database\Seeders;

use App\Models\InformationReceival;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationReceivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Melihat/Membaca/Mendengarkan/Mencatat'],
            ['name' => 'Mendapatkan Salinan Informasi'],
        ];

        foreach ($values as $values) {
            $model = InformationReceival::firstOrCreate($values);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
