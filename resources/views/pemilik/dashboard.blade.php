<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-700">Dashboard Pemilik</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">
                    Pusat kendali operasional kos Anda
                </h2>
            </div>
            <p class="max-w-2xl text-sm leading-6 text-slate-500">
                Akses cepat untuk mengelola kamar, kontrak, tagihan, pembayaran, dan laporan dalam satu tampilan yang lebih rapi.
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">
            <section class="hero-panel rounded-[2rem] px-6 py-8 sm:px-8">
                <div class="grid gap-8 lg:grid-cols-[1.3fr_0.7fr] lg:items-center">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-red-100">Kosku Control Center</p>
                        <h3 class="mt-4 text-3xl font-extrabold tracking-tight sm:text-4xl">Semua kebutuhan pengelolaan kos dalam satu alur kerja.</h3>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-red-50/90">
                            Gunakan menu di bawah untuk memperbarui tipe kamar, memantau kontrak aktif, membuat tagihan, dan memvalidasi pembayaran tanpa berpindah-pindah halaman terlalu jauh.
                        </p>
                    </div>
                    <div class="rounded-[1.75rem] border border-white/15 bg-white/10 p-5 backdrop-blur">
                        <p class="text-sm font-semibold text-red-100">Ringkasan Hari Ini</p>
                        <div class="mt-4 grid gap-3">
                            <div class="rounded-2xl bg-white/10 px-4 py-3">
                                <p class="text-xs uppercase tracking-[0.2em] text-red-100/80">Fokus</p>
                                <p class="mt-1 text-lg font-bold text-white">Pantau tagihan dan validasi pembayaran</p>
                            </div>
                            <div class="rounded-2xl bg-white/10 px-4 py-3">
                                <p class="text-xs uppercase tracking-[0.2em] text-red-100/80">Akses Cepat</p>
                                <p class="mt-1 text-sm text-white/90">Masuk ke menu Tagihan, Konfirmasi Bayar, atau Laporan sesuai kebutuhan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Data Dasar</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Tipe Kamar</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Atur harga, fasilitas, dan kategori kamar dengan tampilan yang lebih rapi.</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Operasional</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Kelola Kamar</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Perbarui informasi kamar, status hunian, dan kondisi unit yang tersedia.</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Penagihan</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Tagihan & Bayar</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Buat tagihan bulanan dan konfirmasi pembayaran penyewa dengan cepat.</p>
                </div>
                <div class="stat-card">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Laporan</p>
                    <h4 class="mt-3 text-xl font-bold text-slate-900">Rekap Keuangan</h4>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Siapkan export laporan untuk kebutuhan pemantauan dan administrasi.</p>
                </div>
            </section>

            <section>
                <div class="mb-5">
                    <h3 class="section-title">Akses Menu Utama</h3>
                    <p class="section-copy mt-2">Pilih area kerja yang ingin Anda kelola dari dashboard pemilik.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    <a href="{{ route('pemilik.room-types.index') }}" class="action-card block">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">01</p>
                        <h4 class="mt-3 text-xl font-bold text-slate-900">Tipe Kamar</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Kelola kategori kamar, fasilitas, dan harga dasar tiap tipe.</p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Buka menu</span>
                    </a>

                    <a href="{{ route('pemilik.rooms.index') }}" class="action-card block">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">02</p>
                        <h4 class="mt-3 text-xl font-bold text-slate-900">Kamar</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Periksa data kamar, lokasi, status, dan foto unit secara terpusat.</p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Buka menu</span>
                    </a>

                    <a href="{{ route('pemilik.tenants.index') }}" class="action-card block">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">03</p>
                        <h4 class="mt-3 text-xl font-bold text-slate-900">Penyewa</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Kelola identitas penghuni, akun login, dan data profil penyewa.</p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Buka menu</span>
                    </a>

                    <a href="{{ route('pemilik.contracts.index') }}" class="action-card block">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">04</p>
                        <h4 class="mt-3 text-xl font-bold text-slate-900">Kontrak</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Atur masa sewa aktif dan cek hubungan antara kamar dan penyewa.</p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Buka menu</span>
                    </a>

                    <a href="{{ route('pemilik.bills.index') }}" class="action-card block">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">05</p>
                        <h4 class="mt-3 text-xl font-bold text-slate-900">Tagihan</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Buat tagihan bulanan, cek jatuh tempo, dan pantau denda.</p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Buka menu</span>
                    </a>

                    <a href="{{ route('pemilik.payments.index') }}" class="action-card block">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">06</p>
                        <h4 class="mt-3 text-xl font-bold text-slate-900">Konfirmasi Bayar</h4>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Tinjau bukti transfer dan pastikan pembayaran tervalidasi dengan benar.</p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-red-700">Buka menu</span>
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
