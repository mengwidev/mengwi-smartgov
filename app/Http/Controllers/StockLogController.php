<?php

namespace App\Http\Controllers;

use App\Models\StockLogModel;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockLogController extends Controller
{
    public function generateReport(Request $request)
    {
        // Get the date range from the query parameters
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $stockLogs = StockLogModel::query()
            ->when(
                $startDate,
                fn($query) => $query->whereDate('date', '>=', $startDate)
            )
            ->when(
                $endDate,
                fn($query) => $query->whereDate('date', '<=', $endDate)
            )
            ->with(['product', 'unit']) // Eager load the related product and unit data
            ->orderBy('date', 'asc') // Sort by date in ascending order
            ->get();

        // Ensure proper formatting of the dates for the filename (e.g., no spaces)
        $formattedStartDate = \Carbon\Carbon::parse($startDate)->format(
            'Y-m-d'
        );
        $formattedEndDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d');

        // Generate the PDF using the filtered data and pass startDate and endDate to the view
        $pdf = Pdf::view('pdf.stock-log-report', [
            'stockLogs' => $stockLogs,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])
            ->paperSize(210, 330, 'mm')
            ->margins(10, 10, 10, 10);

        return $pdf->download(
            'Laporan_Stok_Barang_' .
                $formattedStartDate .
                '_to_' .
                $formattedEndDate .
                '.pdf'
        );

        // TESTING PREVIEW ---------------------------
        // return view(
        //     'pdf.stock-log-report',
        //     compact('stockLogs', 'startDate', 'endDate')
        // );
    }
}
