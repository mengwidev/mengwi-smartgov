<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmploymentUnit;

class EmploymentUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            'Perbekel', 'Sekretaris Desa', 'Tata Usaha dan Umum',
            'Perencanaan', 'Keuangan', 'Kesejahteraan',
            'Pemerintahan', 'Pelayanan', 'BPD',
        ];

        foreach ($units as $name) {
            EmploymentUnit::firstOrCreate(['name' => $name]);
        }
    }
}
