<?php

namespace App\Http\Controllers;

use App\Models\StockLogModel;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;

class StockLogController extends Controller
{
    public function generateReport(Request $request)
    {
        // Get the date range from the query parameters
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // QUERY ALL STOCK LOGS BASED ON DATE FILTER
        $stockLogs = StockLogModel::query()
            ->when(
                $startDate,
                fn ($query) => $query->whereDate('date', '>=', $startDate)
            )
            ->when(
                $endDate,
                fn ($query) => $query->whereDate('date', '<=', $endDate)
            )
            ->with(['product', 'unit'])
            ->orderBy('date', 'asc')
            ->get();

        // QUERY ONLY STOCK IN ON THE STOCK LOGS BASED ON DATE FILTER
        $stockIn = StockLogModel::query()
            ->when(
                $startDate,
                fn ($query) => $query->whereDate('date', '>=', $startDate)
            )
            ->when(
                $endDate,
                fn ($query) => $query->whereDate('date', '<=', $endDate)
            )
            ->where('type', 'in')
            ->with(['product', 'unit'])
            ->orderBy('date', 'asc')
            ->get();

        // QUERY ONLY STOCK OUT ON THE STOCK LOGS BASED ON DATE FILTER
        $stockOut = StockLogModel::query()
            ->when(
                $startDate,
                fn ($query) => $query->whereDate('date', '>=', $startDate)
            )
            ->when(
                $endDate,
                fn ($query) => $query->whereDate('date', '<=', $endDate)
            )
            ->where('type', 'out')
            ->with(['product', 'unit'])
            ->orderBy('date', 'asc')
            ->get();

        // Ensure proper formatting of the dates for the filename (e.g., no spaces)
        $formattedStartDate = \Carbon\Carbon::parse($startDate)->format(
            'Y-m-d'
        );
        $formattedEndDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d');

        // Generate the PDF using the filtered data and pass startDate and endDate to the view
        // $pdf = Pdf::view('pdf.stock-log-report', [
        //     'stockLogs' => $stockLogs,
        //     'stockIn' => $stockIn,
        //     'stockOut' => $stockOut,
        //     'startDate' => $startDate,
        //     'endDate' => $endDate,
        // ])
        //     ->paperSize(210, 330, 'mm')
        //     ->margins(10, 10, 10, 10);

        // return $pdf->download(
        //     'Laporan_Stok_Barang_' .
        //         $formattedStartDate .
        //         '_s/d_' .
        //         $formattedEndDate .
        //         '__timestamps__' .
        //         now() .
        //         '.pdf'
        // );

        // TESTING PREVIEW ---------------------------
        return view(
            'pdf.stock-log-report',
            compact('stockLogs', 'startDate', 'endDate', 'stockIn', 'stockOut')
        );
    }
}
