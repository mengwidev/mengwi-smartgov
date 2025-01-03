<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefEmploymentPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Insert Ref Employment Position Values
        //Pemerintah Desa
        DB::table('ref_employment_position')->insert(['position_name' => 'Perbekel', 'position_category_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Sekretaris Desa', 'position_category_id' => 3, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kepala Seksi Pemerintahan', 'position_category_id' => 5, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kepala Seksi Kesejahteraan', 'position_category_id' => 5, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kepala Seksi Pelayanan', 'position_category_id' => 5, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kepala Urusan Tata Usaha dan Umum', 'position_category_id' => 4, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kepala Urusan Perencanaan', 'position_category_id' => 4, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kepala Urusan Keuangan', 'position_category_id' => 4, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Kelian Banjar Dinas', 'position_category_id' => 6, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Staf Kasi Pemerintahan', 'position_category_id' => 7, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Staf Kasi Kesejahteraan', 'position_category_id' => 7, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Staf Kasi Pelayanan', 'position_category_id' => 7, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Staf Kaur Tata Usaha dan Umum', 'position_category_id' => 7, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Staf Kaur Perencanaan', 'position_category_id' => 7, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Staf Kaur Keuangan', 'position_category_id' => 7, 'created_at' => now(), 'updated_at' => now()]);

        //Badan Permusyawaratan Desa
        DB::table('ref_employment_position')->insert(['position_name' => 'Ketua BPD', 'position_category_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Wakil Ketua BPD', 'position_category_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Sekretaris BPD', 'position_category_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
        DB::table('ref_employment_position')->insert(['position_name' => 'Anggota BPD', 'position_category_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
    }
}
