<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantPaymentController extends Controller
{
    public function create(Bill $bill)
    {
        // Cegah akses jika tagihan sudah lunas atau sedang menunggu konfirmasi
        if ($bill->status === 'lunas' || $bill->status === 'menunggu_konfirmasi') {
            return redirect()->route('penyewa.bills.index')->with('info', 'Tagihan ini sudah dibayar atau sedang diproses oleh Pemilik.');
        }

        $bill->load('contract.room.roomType');
        return view('penyewa.payments.create', compact('bill'));
    }

    public function store(Request $request, Bill $bill)
    {
        // Validasi wajib gambar, format jpeg/png/jpg, maksimal 2MB
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hapus bukti pembayaran lama jika penyewa mengunggah ulang (karena ditolak)
        if ($bill->proof_of_payment) {
            Storage::disk('public')->delete($bill->proof_of_payment);
        }

        // Simpan file gambar ke folder storage/app/public/payment_proofs
        $path = $request->file('proof_of_payment')->store('payment_proofs', 'public');

        // Update tagihan dengan path gambar dan ubah status
        $bill->update([
            'proof_of_payment' => $path,
            'status' => 'menunggu_konfirmasi',
        ]);

        return redirect()->route('penyewa.bills.index')->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi dari Bapak Kos.');
    }
}