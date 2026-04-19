<?php

namespace App\Http\Controllers;

use App\Models\RoomType; // Jangan lupa panggil modelnya
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data tipe kamar dari database
        $roomTypes = RoomType::all();
        // Melempar data ke tampilan view
        return view('pemilik.room_types.index', compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form tambah data
        return view('pemilik.room_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'facilities' => 'nullable|string',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        // Simpan ke database
        RoomType::create($request->all());

        // Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('pemilik.room-types.index')
                         ->with('success', 'Tipe kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}