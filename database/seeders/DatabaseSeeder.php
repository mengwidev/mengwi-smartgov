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
            RefMonthSeeder::class,
            ProductUnitSeeder::class,
            EmploymentUnitSeeder::class,
            EmployeeLevelSeeder::class,
            ProductCategorySeeder::class,
            ContactTypeSeeder::class,
        ]);
    }
}
