<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmploymentUnit;

class EmploymentUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            'Perbekel',
            'Sekretaris Desa',
            'Tata Usaha dan Umum',
            'Perencanaan',
            'Keuangan',
            'Kesejahteraan',
            'Pemerintahan',
            'Pelayanan',
            'BPD',
            'Perangkat Kewilayahan'
        ];

        foreach ($units as $name) {
            $model = EmploymentUnit::firstOrCreate(['name' => $name]);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
