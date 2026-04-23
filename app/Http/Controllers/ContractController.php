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
        $contracts = Contract::with(['tenant.user', 'room.roomType'])->latest()->get();
        return view('pemilik.contracts.index', compact('contracts'));
    }

    public function create()
    {
        $tenants = Tenant::with('user')->get();
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

        $room = Room::findOrFail($request->room_id);
        if ($room->status !== 'kosong') {
            return back()->withInput()->with('error', 'Kamar ini sudah terisi atau tidak tersedia!');
        }

        try {
            DB::beginTransaction();

            $startDate = Carbon::parse($request->start_date);
            $durationMonth = $request->integer('duration_month');
            $endDate = $startDate->copy()->addMonths($durationMonth);

            Contract::create([
                'tenant_id' => $request->tenant_id,
                'room_id' => $request->room_id,
                'start_date' => $request->start_date,
                'end_date' => $endDate,
                'duration_month' => $durationMonth,
                'monthly_price' => $request->monthly_price,
                'status' => 'aktif',
            ]);

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
        $contract->load(['tenant.user', 'room.roomType']);
        return view('pemilik.contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $contract->load(['tenant.user', 'room.roomType']);
        $tenants = Tenant::with('user')->get();
        $rooms = Room::with('roomType')
            ->where(function ($query) use ($contract) {
                $query->where('status', 'kosong')
                    ->orWhere('id', $contract->room_id);
            })
            ->get();

        return view('pemilik.contracts.edit', compact('contract', 'tenants', 'rooms'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date',
            'duration_month' => 'required|integer|min:1',
            'monthly_price' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,selesai,dibatalkan',
        ]);

        $newRoom = Room::findOrFail($request->room_id);
        if ($newRoom->id !== $contract->room_id && $newRoom->status !== 'kosong') {
            return back()->withInput()->with('error', 'Kamar yang dipilih tidak tersedia untuk kontrak ini.');
        }

        try {
            DB::beginTransaction();

            $oldRoom = $contract->room;
            $startDate = Carbon::parse($request->start_date);
            $durationMonth = $request->integer('duration_month');
            $endDate = $startDate->copy()->addMonths($durationMonth);

            $contract->update([
                'tenant_id' => $request->tenant_id,
                'room_id' => $newRoom->id,
                'start_date' => $request->start_date,
                'end_date' => $endDate,
                'duration_month' => $durationMonth,
                'monthly_price' => $request->monthly_price,
                'status' => $request->status,
            ]);

            if ($oldRoom->id !== $newRoom->id) {
                $this->syncRoomStatus($oldRoom);
            }

            $this->syncRoomStatus($newRoom);

            DB::commit();
            return redirect()->route('pemilik.contracts.index')->with('success', 'Kontrak berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui kontrak: ' . $e->getMessage());
        }
    }

    public function destroy(Contract $contract) { abort(404); }

    private function syncRoomStatus(Room $room): void
    {
        $hasActiveContract = Contract::where('room_id', $room->id)
            ->where('status', 'aktif')
            ->exists();

        $room->update([
            'status' => $hasActiveContract ? 'terisi' : 'kosong',
        ]);
    }
}
