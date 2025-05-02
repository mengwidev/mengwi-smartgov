<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run Seeders
        $this->call([
            BanjarSeeder::class,
            MonthSeeder::class,
            ProductUnitSeeder::class,
            EmploymentUnitSeeder::class,
            EmployeeLevelSeeder::class,
            ProductCategorySeeder::class,
            ContactTypeSeeder::class,
            GenderSeeder::class,
            LastEducationSeeder::class,
            MaritalStatusSeeder::class,
            OccupationSeeder::class,
            ReligionSeeder::class
        ]);
    }
}
