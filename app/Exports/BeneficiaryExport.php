<?php

namespace App\Exports;

use App\Models\Beneficiary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class BeneficiaryExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, ShouldAutoSize
{
    protected $beneficiaries;

    public function __construct($beneficiaries = null)
    {
        $this->beneficiaries = $beneficiaries ?? Beneficiary::with(['banjar', 'socialAssistances'])->get();
    }

    public function collection()
    {
        return $this->beneficiaries;
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Nomor KK',
            'Jenis Kelamin',
            'Banjar',
            'Bantuan Sosial',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Latitude',
            'Longitude',
        ];
    }

    public function map($beneficiary): array
    {
        // Parse tanggal_lahir if it's a string
        $tanggalLahir = $beneficiary->tanggal_lahir;
        if (is_string($tanggalLahir)) {
            $tanggalLahir = Carbon::parse($tanggalLahir);
        }

        // Get social assistances sorted by ID
        $socialAssistances = $beneficiary->socialAssistances
            ->sortBy('id') // Sort by ID
            ->pluck('name')
            ->implode(', ');

        // Alternative: Sort by name alphabetically
        // $socialAssistances = $beneficiary->socialAssistances
        //     ->sortBy('name') // Sort by name alphabetically
        //     ->pluck('name')
        //     ->implode(', ');

        return [
            $beneficiary->nomor_induk_kependudukan . "\t",
            $beneficiary->nama_lengkap,
            $beneficiary->nomor_kk . "\t",
            $beneficiary->gender->name,
            $beneficiary->banjar->name ?? '-',
            $socialAssistances, // Use sorted list
            $beneficiary->tempat_lahir,
            $tanggalLahir->format('d/m/Y'),
            $beneficiary->latitude,
            $beneficiary->longitude,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT, // NIK column as text
            'C' => NumberFormat::FORMAT_TEXT, // Nomor KK column as text
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY
            // Dates are already strings, so no need for special formatting
        ];
    }
}
