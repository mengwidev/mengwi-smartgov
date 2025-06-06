<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Religion;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            'Islam',
            'Kristen',
            'Katholik',
            'Hindu',
            'Budha',
            'Lainnya'
        ];

        foreach ($religions as $religion) {
            $model = Religion::firstOrCreate(['name' => $religion]);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
