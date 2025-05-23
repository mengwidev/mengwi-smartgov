<?php

namespace Database\Seeders;

use App\Models\ApplicationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            ['name' => 'Permohonan Diajukan'],
            ['name' => 'Sedang Diproses'],
            ['name' => 'Permohonan Ditolak'],
            ['name' => 'Informasi Terkirim'],
            ['name' => 'Proses Verifikasi Pemohon'],
            ['name' => 'Pemohon Keberatan'],
            ['name' => 'Pemohon Mengajukan Sengketa'],
            ['name' => 'Permohonan Selesai']
        ];

        foreach ($values as $value) {
            $model = ApplicationStatus::forceCreate($value);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
