<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeLevel;

class EmployeeLevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            'Perbekel',
            'Sekretaris Desa',
            'Kepala Urusan',
            'Kepala Seksi',
            'Staf',
            'Petugas',
            'Operator',
            'Kelian Banjar Dinas'
        ];

        foreach ($levels as $name) {
            EmployeeLevel::firstOrCreate(['name' => $name]);
        }
    }
}
