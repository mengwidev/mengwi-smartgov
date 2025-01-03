<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefAttTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert Ref Att Type values
        DB::table('ref_att_type')->insert(['name' => 'IN', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_att_type')->insert(['name' => 'OUT', 'created_at' => now(), 'updated_at' => now()]);
    }
}
