<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KedudukanPpid;

class KedudukanPpidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Atasan PPID Tingkat Desa'],
            ['name' => 'Ketua PPID Tingkat Desa'],
            ['name' => 'Bidang Pengelolaan Informasi'],
            ['name' => 'Bidang Dokumentasi Informasi dan Arsip'],
            ['name' => 'Bidang Pendukung Sekretariat PPID'],
            ['name' => 'Bidang Pengolahan Data dan Klasifikasi Informasi'],
            ['name' => 'Bidang Pelayanan Informasi dan Dokumentasi'],
            ['name' => 'Bidang Fasilitasi Sengketa Informasi'],
        ];

        foreach ($values as $value) {
            $model = KedudukanPpid::firstOrCreate($value);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
