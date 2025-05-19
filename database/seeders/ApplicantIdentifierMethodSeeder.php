<?php

namespace Database\Seeders;

use App\Models\ApplicantIdentifierMethod;
use App\Models\ApplicantIdetifierMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicantIdentifierMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ["name" => "KTP"],
            ["name" => "SIM"],
        ];

        foreach ($values as $value) {
            $model = ApplicantIdentifierMethod::firstOrCreate($value);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
