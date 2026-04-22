<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Contract;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BillController extends Controller
{
    public function index()
    {
        // 1. Logika Denda Otomatis (Auto-Calculate Fine)
        // Mengecek tagihan yang belum lunas dan sudah lewat jatuh tempo hari ini
        $unpaidBills = Bill::where('status', '!=', 'lunas')
                            ->whereDate('due_date', '<', Carbon::now()->toDateString())
                            ->get();

        foreach ($unpaidBills as $bill) {
            // Jika denda masih 0, tambahkan denda (misal: Rp 50.000 flat)
            if ($bill->fine == 0) {
                $bill->update(['fine' => 50000]);
            }
        }

        // 2. Ambil semua data tagihan terbaru beserta relasinya
        $bills = Bill::with(['contract.tenant.user', 'contract.room.roomType'])->latest()->get();
        
        return view('pemilik.bills.index', compact('bills'));
    }

    public function generate()
    {
        // Ambil semua kontrak yang masih "aktif"
        $activeContracts = Contract::where('status', 'aktif')->get();
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $generatedCount = 0;

        foreach ($activeContracts as $contract) {
            // Cek apakah tagihan untuk kontrak ini sudah pernah dibuat di bulan & tahun ini
            $existingBill = Bill::where('contract_id', $contract->id)
                                ->whereMonth('created_at', $currentMonth)
                                ->whereYear('created_at', $currentYear)
                                ->first();

            // Jika belum ada tagihan bulan ini, buat baru
            if (!$existingBill) {
                Bill::create([
                    'contract_id' => $contract->id,
                    'amount' => $contract->monthly_price,
                    // Jatuh tempo diset 7 hari dari tanggal generate
                    'due_date' => Carbon::now()->addDays(7)->toDateString(), 
                    'fine' => 0,
                    'status' => 'belum_dibayar'
                ]);
                $generatedCount++;
            }
        }

        if ($generatedCount > 0) {
            return redirect()->route('pemilik.bills.index')->with('success', "$generatedCount Tagihan baru untuk bulan ini berhasil di-generate!");
        } else {
            return redirect()->route('pemilik.bills.index')->with('info', 'Semua tagihan untuk bulan ini sudah dibuat sebelumnya. Tidak ada duplikasi.');
        }
    }
}