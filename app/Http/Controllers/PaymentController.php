<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $pendingPayments = Bill::with(['contract.tenant.user', 'contract.room'])
                                ->where('status', 'menunggu_konfirmasi')
                                ->latest()
                                ->get();

        return view('pemilik.payments.index', compact('pendingPayments'));
    }

    public function approve(Bill $bill)
    {
        if ($bill->status !== 'menunggu_konfirmasi') {
            return back()->with('error', 'Status tagihan ini tidak valid untuk dikonfirmasi.');
        }

        $bill->update([
            'status' => 'lunas',
        ]);

        return redirect()->route('pemilik.payments.index')->with('success', 'Pembayaran berhasil dikonfirmasi dan tagihan dinyatakan Lunas.');
    }

    public function reject(Bill $bill)
    {
        $bill->update([
            'status' => 'belum_bayar',
            'proof_of_payment' => null // Opsional: hapus bukti yang salah agar penyewa upload ulang
        ]);

        return redirect()->route('pemilik.payments.index')->with('info', 'Pembayaran ditolak. Penyewa diminta untuk mengunggah ulang bukti pembayaran.');
    }

    public function edit(Bill $bill)
    {
        $bill->load(['contract.tenant.user', 'contract.room.roomType']);
        return view('pemilik.payments.edit', compact('bill'));
    }

    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'status' => 'required|in:belum_bayar,menunggu_konfirmasi,lunas',
            'due_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'fine' => 'required|numeric|min:0',
            'clear_proof' => 'nullable|boolean',
        ]);

        $data = $request->only(['status', 'due_date', 'amount', 'fine']);

        if ($request->boolean('clear_proof') && $bill->proof_of_payment) {
            Storage::disk('public')->delete($bill->proof_of_payment);
            $data['proof_of_payment'] = null;
        }

        if ($data['status'] === 'belum_bayar' && $bill->proof_of_payment && !array_key_exists('proof_of_payment', $data)) {
            $data['proof_of_payment'] = $bill->proof_of_payment;
        }

        $bill->update($data);

        return redirect()->route('pemilik.payments.index')->with('success', 'Konfirmasi pembayaran berhasil diperbarui!');
    }
}
