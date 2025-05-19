<?php

namespace Database\Seeders;

use App\Models\ApplicationMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Offline'],
            ['name' => 'Online'],
        ];

        foreach ($values as $value) {
            $model = ApplicationMethod::firstOrCreate($value);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
