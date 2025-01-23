<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Run Seeders
        $this->call([
            RefAttTypeSeeder::class,
            RefBanjarSeeder::class,
            RefEmploymentPositionCategorySeeder::class,
            RefEmploymentPositionSeeder::class,
            RefLastEducationSeeder::class,
            RefMonthSeeder::class,
            ProductUnitSeeder::class,
        ]);
    }
}
