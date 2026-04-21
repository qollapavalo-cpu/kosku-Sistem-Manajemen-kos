<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        // Memanggil data kamar beserta relasi tipe kamarnya (Eager Loading)
        $rooms = Room::with('roomType')->get();
        return view('pemilik.rooms.index', compact('rooms'));
    }

    public function create()
    {
        // Mengambil semua tipe kamar untuk ditampilkan di dropdown
        $roomTypes = RoomType::all();
        return view('pemilik.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:10|unique:rooms,room_number',
            'floor' => 'required|integer|min:1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        $data = $request->all();

        // Jika ada file foto yang diupload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('rooms', 'public');
            $data['photo'] = $path;
        }

        Room::create($data);

        return redirect()->route('pemilik.rooms.index')->with('success', 'Data kamar berhasil ditambahkan!');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('pemilik.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:10|unique:rooms,room_number,' . $room->id,
            'floor' => 'required|integer|min:1',
            'status' => 'required|in:kosong,terisi,maintenance',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Jika upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($room->photo) {
                Storage::disk('public')->delete($room->photo);
            }
            // Simpan foto baru
            $path = $request->file('photo')->store('rooms', 'public');
            $data['photo'] = $path;
        }

        $room->update($data);

        return redirect()->route('pemilik.rooms.index')->with('success', 'Data kamar berhasil diperbarui!');
    }

    public function destroy(Room $room)
    {
        // Hapus foto fisik dari storage jika ada
        if ($room->photo) {
            Storage::disk('public')->delete($room->photo);
        }
        
        $room->delete();

        return redirect()->route('pemilik.rooms.index')->with('success', 'Data kamar berhasil dihapus!');
    }
}