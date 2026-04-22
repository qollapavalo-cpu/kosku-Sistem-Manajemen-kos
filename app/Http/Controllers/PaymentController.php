<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        // Hanya menampilkan tagihan yang sudah diupload bukti bayarnya oleh penyewa
        $pendingPayments = Bill::with(['contract.tenant.user', 'contract.room'])
                                ->where('status', 'menunggu_konfirmasi')
                                ->latest()
                                ->get();

        return view('pemilik.payments.index', compact('pendingPayments'));
    }

    public function approve(Bill $bill)
    {
        // Pastikan tagihan memang dalam status menunggu konfirmasi
        if ($bill->status !== 'menunggu_konfirmasi') {
            return back()->with('error', 'Status tagihan ini tidak valid untuk dikonfirmasi.');
        }

        // Update status tagihan menjadi lunas
        $bill->update([
            'status' => 'lunas',
            // Jika di database ada kolom approved_by, kita catat ID pemilik yang login
            // 'approved_by' => Auth::id(), 
        ]);

        return redirect()->route('pemilik.payments.index')->with('success', 'Pembayaran berhasil dikonfirmasi dan tagihan dinyatakan Lunas.');
    }

    public function reject(Bill $bill)
    {
        // Jika bukti transfer palsu atau tidak jelas, Admin bisa menolak
        $bill->update([
            'status' => 'belum_dibayar',
            'proof_of_payment' => null // Opsional: hapus bukti yang salah agar penyewa upload ulang
        ]);

        return redirect()->route('pemilik.payments.index')->with('info', 'Pembayaran ditolak. Penyewa diminta untuk mengunggah ulang bukti pembayaran.');
    }
}