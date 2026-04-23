<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-700">Pembayaran</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                    {{ __('Upload Bukti Pembayaran') }}
                </h2>
            </div>
            <p class="max-w-xl text-sm leading-6 text-slate-500">Pastikan nominal dan bukti transfer terlihat jelas sebelum Anda mengirim pembayaran.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
                <div class="hero-panel rounded-[2rem] px-6 py-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-red-100">Detail Tagihan</p>
                    <h3 class="mt-4 text-3xl font-extrabold tracking-tight">Siapkan pembayaran Anda</h3>

                    <div class="mt-6 space-y-4 text-sm text-white/90">
                        <div class="rounded-2xl bg-white/10 px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.22em] text-red-100/80">Periode</p>
                            <p class="mt-2 text-lg font-bold text-white">{{ \Carbon\Carbon::createFromDate($bill->period_year, $bill->period_month, 1)->translatedFormat('F Y') }}</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.22em] text-red-100/80">Kamar</p>
                            <p class="mt-2 text-lg font-bold text-white">Kamar {{ $bill->contract->room->room_number }} ({{ $bill->contract->room->roomType->name }})</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.22em] text-red-100/80">Total Harus Dibayar</p>
                            <p class="mt-2 text-2xl font-extrabold text-white">Rp {{ number_format($bill->amount + $bill->fine, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="glass-panel rounded-[2rem] p-6 sm:p-8">
                    <form action="{{ route('penyewa.payments.store', $bill->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50/70 p-5">
                            <label class="block text-sm font-bold uppercase tracking-[0.18em] text-slate-700">
                                Foto Bukti Pembayaran <span class="text-red-500">*</span>
                            </label>
                            <p class="mt-2 text-sm leading-6 text-slate-500">Unggah file JPG, JPEG, atau PNG. Pastikan nominal transfer dan detail transaksi dapat dibaca dengan jelas.</p>

                            <input
                                type="file"
                                name="proof_of_payment"
                                accept=".jpg,.jpeg,.png"
                                required
                                class="mt-5 block w-full rounded-2xl border border-dashed border-red-200 bg-white px-4 py-4 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-red-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-red-700"
                            >

                            <p class="mt-3 text-xs font-medium text-slate-500">Format yang diizinkan: JPG, JPEG, PNG. Maksimal ukuran file: 2MB.</p>

                            @error('proof_of_payment')
                                <p class="mt-3 text-sm font-medium text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <a href="{{ route('penyewa.bills.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-red-700 via-red-600 to-red-500 px-5 py-3 text-sm font-bold text-white shadow-[0_18px_35px_-18px_rgba(127,29,29,0.8)] transition hover:-translate-y-0.5">
                                Upload Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
