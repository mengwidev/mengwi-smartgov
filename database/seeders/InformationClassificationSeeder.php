<?php

namespace Database\Seeders;

use App\Models\InformationClassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            [
                'name' => 'Informasi Berkala',
                'description' => 'Informasi yang wajib disediakan dan diumumkan secara rutin oleh badan publik, tanpa perlu ada permintaan dari masyarakat. Informasi ini bersifat proaktif, artinya instansi atau badan publik harus menyampaikan secara terbuka melalui berbagai saluran, seperti website resmi, papan pengumuman, atau laporan tahunan. Contoh informasi berkala meliputi laporan keuangan, program kerja, laporan kinerja instansi, dan statistik layanan. Tujuannya adalah untuk menciptakan transparansi dan akuntabilitas publik secara berkesinambungan.'
            ],
            [
                'name' => 'Informasi Tersedia Setiap Saat',
                'description' => 'Jenis informasi yang tidak diwajibkan untuk diumumkan secara berkala, tetapi harus tetap disiapkan dan dapat diakses oleh publik kapan pun diminta. Informasi ini meliputi dokumen atau data yang mungkin relevan bagi masyarakat dalam konteks tertentu, seperti keputusan pimpinan, daftar aset, atau dokumen perizinan. Badan publik wajib memastikan bahwa informasi tersebut selalu tersedia, terarsip dengan baik, dan dapat diakses tanpa penundaan yang tidak perlu melalui unit layanan informasi atau PPID.'
            ],
            [
                'name' => 'Informasi Serta Merta',
                'description' => 'Informasi yang harus segera diumumkan tanpa menunggu adanya permintaan, terutama jika berkaitan dengan keselamatan publik, hajat hidup orang banyak, atau kondisi darurat. Misalnya, dalam situasi bencana alam, wabah penyakit, gangguan layanan penting, atau kejadian luar biasa lainnya, informasi harus disampaikan secara cepat dan luas. Tujuan utamanya adalah untuk memberikan peringatan dini, menjaga keselamatan masyarakat, dan mencegah kekacauan informasi di ruang publik.'
            ],
            [
                'name' => 'Informasi Dikecualikan',
                'description' => 'Informasi yang tidak dapat diakses oleh publik karena alasan perlindungan terhadap kepentingan yang lebih besar, seperti keamanan negara, kerahasiaan pribadi, rahasia dagang, atau proses penegakan hukum. Pengelompokan ini dilakukan melalui mekanisme uji konsekuensi yang ketat, untuk memastikan bahwa keterbukaan informasi tidak menimbulkan dampak negatif yang lebih besar daripada manfaatnya. Informasi yang termasuk dalam kategori ini antara lain dokumen intelijen, strategi pertahanan, data pribadi penduduk, serta dokumen hukum yang masih dalam proses peradilan.'
            ],
        ];

        foreach ($values as $value) {
            $model = InformationClassification::firstOrCreate($value);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
