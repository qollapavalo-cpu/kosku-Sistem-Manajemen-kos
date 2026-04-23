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
        $unpaidBills = Bill::where('status', '!=', 'lunas')
                            ->whereDate('due_date', '<', Carbon::now()->toDateString())
                            ->get();

        foreach ($unpaidBills as $bill) {
            if ($bill->fine == 0) {
                $bill->update(['fine' => 50000]);
            }
        }

        $bills = Bill::with(['contract.tenant.user', 'contract.room.roomType'])->latest()->get();
        
        return view('pemilik.bills.index', compact('bills'));
    }

    public function generate()
    {
        $activeContracts = Contract::where('status', 'aktif')->get();
        
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $generatedCount = 0;

        foreach ($activeContracts as $contract) {
            $existingBill = Bill::where('contract_id', $contract->id)
                                ->where('period_month', $currentMonth)
                                ->where('period_year', $currentYear)
                                ->first();

            if (!$existingBill) {
                Bill::create([
                    'contract_id' => $contract->id,
                    'period_month' => $currentMonth,
                    'period_year' => $currentYear,
                    'amount' => $contract->monthly_price,
                    'due_date' => Carbon::now()->addDays(7)->toDateString(), 
                    'fine' => 0,
                    'status' => 'belum_bayar'
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

    public function edit(Bill $bill)
    {
        $bill->load(['contract.tenant.user', 'contract.room.roomType']);
        $contracts = Contract::with(['tenant.user', 'room.roomType'])->where('status', 'aktif')->get();

        return view('pemilik.bills.edit', compact('bill', 'contracts'));
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'period_month' => 'required|integer|between:1,12',
            'period_year' => 'required|integer|min:2000|max:2100',
            'amount' => 'required|numeric|min:0',
            'fine' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'status' => 'required|in:belum_bayar,menunggu_konfirmasi,lunas',
        ]);

        $exists = Bill::where('contract_id', $request->contract_id)
            ->where('period_month', $request->period_month)
            ->where('period_year', $request->period_year)
            ->where('id', '!=', $bill->id)
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors([
                'period_month' => 'Tagihan untuk kontrak dan periode ini sudah ada.',
            ]);
        }

        $bill->update($request->only([
            'contract_id',
            'period_month',
            'period_year',
            'amount',
            'fine',
            'due_date',
            'status',
        ]));

        return redirect()->route('pemilik.bills.index')->with('success', 'Tagihan berhasil diperbarui!');
    }
}
