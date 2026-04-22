<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantBillController extends Controller
{
    public function index()
    {
        // 1. Cari profil tenant milik user yang sedang login
        $tenant = Tenant::where('user_id', Auth::id())->first();

        // Jaga-jaga jika admin belum membuatkan profil tenant
        if (!$tenant) {
            return redirect()->route('penyewa.dashboard')->with('error', 'Profil penyewa Anda belum lengkap. Silakan hubungi Bapak Kos.');
        }

        // 2. Ambil tagihan yang hanya berelasi dengan ID tenant ini
        $bills = Bill::whereHas('contract', function($query) use ($tenant) {
                    $query->where('tenant_id', $tenant->id);
                })
                ->with(['contract.room.roomType'])
                ->latest()
                ->get();

        return view('penyewa.bills.index', compact('bills'));
    }
}