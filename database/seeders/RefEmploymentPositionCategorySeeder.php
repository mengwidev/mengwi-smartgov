<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RefEmploymentPositionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert employment position category seeder data
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Perbekel',
            'description' => 'Pejabat Pemerintah Desa yang mempunyai wewenang, tugas dan kewajiban untuk menyelenggarakan rumah tangga Desanya dan melaksanakan tugas dari Pemerintah dan Pemerintah Daerah.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Badan Permusyawaratan Desa',
            'description' => 'Lembaga yang melaksanakan fungsi pemerintahan desa, seperti membahas dan menyepakati rancangan peraturan desa, menampung aspirasi masyarakat, dan mengawasi kinerja kepala desa.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Sekretaris Desa',
            'description' => 'Sekretaris Desa bertugas membantu Kepala Desa dalam bidang administrasi pemerintahan.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Kepala Urusan',
            'description' => 'Kepala urusan bertugas membantu Sekretaris Desa dalam urusan pelayanan administrasi pendukung pelaksanaan tugas-tugas pemerintahan.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Pelaksana Teknis',
            'description' => 'Pelaksana teknis merupakan unsur pembantu Kepala Desa sebagai pelaksana tugas operasional.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Pelaksana Kewilayahan',
            'description' => 'Kepala Kewilayahan atau sebutan lainnya berkedudukan sebagai unsur satuan tugas kewilayahan yang bertugas membantu Kepala Desa dalam pelaksanaan tugasnya diwilayahnya.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('ref_employment_position_category')->insert([
            'position_category_name' => 'Unsur Staf Perangkat Desa',
            'description' => 'Unsur Staf Perangkat Desa adalah tim pendukung yang secara langsung membantu Kepala Urusan (Kaur) atau Kepala Seksi (Kasi) dalam menjalankan tugas-tugas sehari-hari di pemerintahan desa. Mereka berperan penting dalam memastikan kelancaran pelayanan publik dan pelaksanaan program-program pembangunan di tingkat desa.',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
