<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RefMonth;

class RefMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Juni',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];

        foreach ($values as $value) {
            RefMonth::firstOrCreate(
                ['name' => $value],
                [
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
