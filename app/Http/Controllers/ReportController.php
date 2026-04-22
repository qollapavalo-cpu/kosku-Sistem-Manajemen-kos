<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('pemilik.reports.index');
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Ambil data tagihan yang LUNAS dalam rentang tanggal
        $bills = Bill::with(['contract.tenant.user', 'contract.room'])
                    ->where('status', 'lunas')
                    ->whereBetween('updated_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                    ->get();

        if ($bills->isEmpty()) {
            return back()->with('error', 'Tidak ada data transaksi lunas pada rentang tanggal tersebut.');
        }

        // Nama file yang akan didownload
        $fileName = 'Laporan_Keuangan_Kos_' . $startDate . '_sd_' . $endDate . '.csv';

        // Header untuk memberitahu browser bahwa ini adalah file CSV
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Kolom header CSV
        $columns = ['Tanggal Lunas', 'Penyewa', 'Kamar', 'Bulan Tagihan', 'Nominal', 'Denda', 'Total'];

        $callback = function() use($bills, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bills as $bill) {
                fputcsv($file, [
                    $bill->updated_at->format('d-m-Y H:i'),
                    $bill->contract->tenant->user->name,
                    $bill->contract->room->room_number,
                    Carbon::parse($bill->created_at)->format('F Y'),
                    $bill->amount,
                    $bill->fine,
                    $bill->amount + $bill->fine,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}