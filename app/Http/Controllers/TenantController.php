<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('user')->get();
        return view('pemilik.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('pemilik.tenants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|max:20|unique:tenants',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'ktp_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // 1. Buat User Account
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('penyewa123'), // Password default
                'role' => 'penyewa',
            ]);

            // 2. Handle Upload KTP
            $ktpPath = null;
            if ($request->hasFile('ktp_photo')) {
                $ktpPath = $request->file('ktp_photo')->store('ktp_photos', 'public');
            }

            // 3. Buat Profil Tenant
            Tenant::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'phone' => $request->phone,
                'address' => $request->address,
                'ktp_photo' => $ktpPath,
            ]);

            DB::commit();
            return redirect()->route('pemilik.tenants.index')->with('success', 'Penyewa dan akun berhasil dibuat! Password default: penyewa123');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menambahkan penyewa: ' . $e->getMessage());
        }
    }

    public function edit(Tenant $tenant)
    {
        return view('pemilik.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'nik' => 'required|string|max:20|unique:tenants,nik,' . $tenant->id,
            'ktp_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Update nama di tabel users
            $tenant->user->update(['name' => $request->name]);

            $data = $request->only(['nik', 'phone', 'address']);

            if ($request->hasFile('ktp_photo')) {
                if ($tenant->ktp_photo) {
                    Storage::disk('public')->delete($tenant->ktp_photo);
                }
                $data['ktp_photo'] = $request->file('ktp_photo')->store('ktp_photos', 'public');
            }

            $tenant->update($data);

            DB::commit();
            return redirect()->route('pemilik.tenants.index')->with('success', 'Data penyewa berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data.');
        }
    }

    public function destroy(Tenant $tenant)
    {
        // Menghapus tenant otomatis menghapus user karena cascadeOnDelete di migration
        if ($tenant->ktp_photo) {
            Storage::disk('public')->delete($tenant->ktp_photo);
        }
        
        $tenant->user->delete(); 
        return redirect()->route('pemilik.tenants.index')->with('success', 'Penyewa berhasil dihapus.');
    }
}