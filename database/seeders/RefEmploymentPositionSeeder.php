<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefEmploymentPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            // Pemerintah Desa
            ['position_name' => 'Perbekel', 'position_category_id' => 1],
            ['position_name' => 'Sekretaris Desa', 'position_category_id' => 3],
            [
                'position_name' => 'Kepala Seksi Pemerintahan',
                'position_category_id' => 5,
            ],
            [
                'position_name' => 'Kepala Seksi Kesejahteraan',
                'position_category_id' => 5,
            ],
            [
                'position_name' => 'Kepala Seksi Pelayanan',
                'position_category_id' => 5,
            ],
            [
                'position_name' => 'Kepala Urusan Tata Usaha dan Umum',
                'position_category_id' => 4,
            ],
            [
                'position_name' => 'Kepala Urusan Perencanaan',
                'position_category_id' => 4,
            ],
            [
                'position_name' => 'Kepala Urusan Keuangan',
                'position_category_id' => 4,
            ],
            [
                'position_name' => 'Kelian Banjar Dinas',
                'position_category_id' => 6,
            ],
            [
                'position_name' => 'Staf Kasi Pemerintahan',
                'position_category_id' => 7,
            ],
            [
                'position_name' => 'Staf Kasi Kesejahteraan',
                'position_category_id' => 7,
            ],
            [
                'position_name' => 'Staf Kasi Pelayanan',
                'position_category_id' => 7,
            ],
            [
                'position_name' => 'Staf Kaur Tata Usaha dan Umum',
                'position_category_id' => 7,
            ],
            [
                'position_name' => 'Staf Kaur Perencanaan',
                'position_category_id' => 7,
            ],
            [
                'position_name' => 'Staf Kaur Keuangan',
                'position_category_id' => 7,
            ],

            // Badan Permusyawaratan Desa
            ['position_name' => 'Ketua BPD', 'position_category_id' => 2],
            ['position_name' => 'Wakil Ketua BPD', 'position_category_id' => 2],
            ['position_name' => 'Sekretaris BPD', 'position_category_id' => 2],
            ['position_name' => 'Anggota BPD', 'position_category_id' => 2],
        ];

        // Add timestamps
        $positions = array_map(
            fn ($position) => array_merge($position, [
                'created_at' => now(),
                'updated_at' => now(),
            ]),
            $positions
        );

        // Insert or update existing records
        DB::table('ref_employment_position')->upsert(
            $positions,
            ['position_name'], // Unique column to check for duplicates
            ['position_category_id', 'updated_at'] // Fields to update if exists
        );
    }
}
