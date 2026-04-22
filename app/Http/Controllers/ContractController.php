<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function index()
    {
        // Menampilkan daftar kontrak beserta relasi penyewa dan kamar
        $contracts = Contract::with(['tenant.user', 'room.roomType'])->latest()->get();
        return view('pemilik.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $tenants = Tenant::with('user')->get();
        // PENTING: Hanya tampilkan kamar yang statusnya 'kosong'
        $rooms = Room::with('roomType')->where('status', 'kosong')->get();
        
        return view('pemilik.contracts.create', compact('tenants', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'duration_month' => 'required|integer|min:1',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        // Proteksi Ganda: Pastikan kamar masih kosong sebelum diproses
        $room = Room::findOrFail($request->room_id);
        if ($room->status !== 'kosong') {
            return back()->withInput()->with('error', 'Kamar ini sudah terisi atau tidak tersedia!');
        }

        try {
            DB::beginTransaction();

            // Hitung otomatis End Date menggunakan Carbon
            $startDate = Carbon::parse($request->start_date);
            $endDate = $startDate->copy()->addMonths($request->duration_month);

            // 1. Buat data Kontrak
            Contract::create([
                'tenant_id' => $request->tenant_id,
                'room_id' => $request->room_id,
                'start_date' => $request->start_date,
                'end_date' => $endDate,
                'duration_month' => $request->duration_month,
                'monthly_price' => $request->monthly_price,
                'status' => 'aktif',
            ]);

            // 2. Ubah status kamar menjadi 'terisi'
            $room->update(['status' => 'terisi']);

            DB::commit();
            return redirect()->route('pemilik.contracts.index')->with('success', 'Kontrak berhasil dibuat dan status Kamar otomatis menjadi Terisi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function show(Contract $contract)
    {
        // Load relasi agar data lengkap bisa ditampilkan di detail
        $contract->load(['tenant.user', 'room.roomType']);
        return view('pemilik.contracts.show', compact('contract'));
    }

    // Fungsi edit/update/destroy bisa dikosongkan sementara karena kontrak berjalan biasanya tidak diedit secara bebas tanpa addendum khusus.
    public function edit(Contract $contract) { abort(404); }
    public function update(Request $request, Contract $contract) { abort(404); }
    public function destroy(Contract $contract) { abort(404); }
}