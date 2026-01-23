<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialAssistance;

class SocialAssistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'name' => 'BUHR',
                'description' => 'Bantuan tunai dari Pemkab Badung untuk membantu masyarakat Hindu menghadapi kenaikan harga menjelang Hari Raya Galungan & Kuningan, serta menjaga daya beli. Ditegaskan bukan Tunjangan Hari Raya, tetapi stimulus ekonomi daerah.'
            ],
            [
                'name' => 'BRLH/Bedah Rumah',
                'description' => 'Program untuk meningkatkan kesejahteraan dengan menyediakan hunian layak bagi Masyarakat Berpenghasilan Rendah (MBR) di Badung.'
            ],
            [
                'name' => 'Rehab Rumah',
                'description' => 'Merupakan program perbaikan/peningkatan kualitas rumah yang sudah ada agar menjadi layak huni.'
            ],
            [
                'name' => 'UEP',
                'description' => 'Bantuan untuk meningkatkan kemampuan ekonomi, sering diberikan dalam bentuk barang modal atau pelatihan kepada kelompok usaha.'
            ],
            [
                'name' => 'BLT-DD',
                'description' => 'Program dari pemerintah Indonesia yang memberikan bantuan tunai langsung kepada keluarga miskin atau rentan di desa menggunakan alokasi dari Dana Desa, bertujuan membantu kebutuhan dasar dan mengurangi kemiskinan ekstrem, dengan pencairan rutin (biasanya bulanan) melalui keputusan musyawarah desa.'
            ],
            [
                'name' => 'BPNT',
                'description' => 'Program pemerintah Indonesia untuk membantu keluarga kurang mampu memenuhi kebutuhan pangan pokok (seperti beras, telur, dll.) melalui saldo elektronik yang disalurkan lewat Kartu Keluarga Sejahtera (KKS).'
            ],
            [
                'name' => 'PKH',
                'description' => 'Merupakan program bantuan bersyarat nasional dari Kementerian Sosial untuk keluarga sangat miskin. Kelayakan dan penyalurannya mengikuti database terpadu pemerintah pusat.'
            ],
            [
                'name' => 'Ketahanan Pangan',
                'description' => 'Program Pemerintah Kabupaten Badung untuk mendukung kemandirian pangan, baik dalam bidang pertanian atau peternakan'
            ],
        ];

        foreach ($values as $value) {
            $model = SocialAssistance::firstOrCreate($value);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
