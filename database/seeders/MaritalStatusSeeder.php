<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaritalStatus;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maritalStatuses = [
            'Belum Kawin',
            'Kawin',
            'Cerai Hidup',
            'Cerai Mati'
        ];

        foreach ($maritalStatuses as $maritalStatus) {
            MaritalStatus::firstOrCreate(['name' => $maritalStatus]);
        }
    }
}
