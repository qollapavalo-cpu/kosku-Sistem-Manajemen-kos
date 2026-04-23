<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-700">Dashboard Penyewa</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                    Ringkas, jelas, dan siap untuk pembayaran
                </h2>
            </div>
            <p class="max-w-xl text-sm leading-6 text-slate-500">
                Pantau tagihan aktif, unggah bukti pembayaran, dan cek status pembayaran dari satu halaman yang nyaman dilihat.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">
            <section class="hero-panel rounded-[2rem] px-6 py-8 sm:px-8">
                <div class="grid gap-6 lg:grid-cols-[1.25fr_0.75fr] lg:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-red-100">Tenant Area</p>
                        <h3 class="mt-4 text-3xl font-extrabold tracking-tight sm:text-4xl">Semua kebutuhan tagihan Anda ada di sini.</h3>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-red-50/90">
                            Lihat total yang harus dibayar, cek jatuh tempo, lalu unggah bukti transfer dengan alur yang sederhana dan lebih nyaman dipakai.
                        </p>
                    </div>
                    <div class="rounded-[1.75rem] border border-white/15 bg-white/10 p-5 backdrop-blur">
                        <p class="text-sm font-semibold text-red-100">Langkah Cepat</p>
                        <div class="mt-4 space-y-3 text-sm text-white/90">
                            <div class="rounded-2xl bg-white/10 px-4 py-3">1. Buka menu <span class="font-semibold">Tagihan Saya</span>.</div>
                            <div class="rounded-2xl bg-white/10 px-4 py-3">2. Cek nominal, jatuh tempo, dan denda jika ada.</div>
                            <div class="rounded-2xl bg-white/10 px-4 py-3">3. Unggah bukti pembayaran lalu tunggu validasi pemilik.</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Tagihan</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Pantau Nominal</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Lihat tagihan aktif dan total pembayaran yang harus disiapkan.</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Jatuh Tempo</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Hindari Keterlambatan</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Cek tanggal penting agar pembayaran tetap tepat waktu.</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Pembayaran</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Upload Bukti</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Kirim bukti transfer langsung dari halaman pembayaran penyewa.</p>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <a href="{{ route('penyewa.bills.index') }}" class="action-card block">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Menu Utama</p>
                    <h4 class="mt-3 text-2xl font-bold text-slate-900">Tagihan Saya</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Buka daftar tagihan bulanan Anda, cek total pembayaran, dan lanjut ke proses bayar.</p>
                    <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Lihat tagihan</span>
                </a>

                <div class="action-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Tips</p>
                    <h4 class="mt-3 text-2xl font-bold text-slate-900">Pastikan bukti pembayaran jelas</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Gunakan foto atau screenshot yang menampilkan nominal, tanggal transaksi, dan nama tujuan transfer agar proses validasi lebih cepat.</p>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
