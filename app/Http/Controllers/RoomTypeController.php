<?php

namespace App\Http\Controllers;

use App\Models\RoomType; // Jangan lupa panggil modelnya
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('pemilik.room_types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('pemilik.room_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:room_types,name',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        RoomType::create($request->only([
            'name',
            'description',
            'facilities',
            'monthly_price',
        ]));

        return redirect()->route('pemilik.room-types.index')
                         ->with('success', 'Tipe kamar berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('pemilik.room_types.edit', compact('roomType'));
    }

    public function update(Request $request, string $id)
    {
        $roomType = RoomType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50|unique:room_types,name,' . $roomType->id,
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        $roomType->update($request->only([
            'name',
            'description',
            'facilities',
            'monthly_price',
        ]));

        return redirect()->route('pemilik.room-types.index')
                         ->with('success', 'Tipe kamar berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $roomType = RoomType::withCount('rooms')->findOrFail($id);

        if ($roomType->rooms_count > 0) {
            return redirect()->route('pemilik.room-types.index')
                ->with('error', 'Tipe kamar tidak bisa dihapus karena masih dipakai oleh data kamar.');
        }

        $roomType->delete();

        return redirect()->route('pemilik.room-types.index')
            ->with('success', 'Tipe kamar berhasil dihapus!');
    }
}
