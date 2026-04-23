<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-700">Tagihan Bulanan</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">{{ __('Kelola Tagihan Bulanan') }}</h2>
            </div>
            <p class="max-w-2xl text-sm leading-6 text-slate-500">Buat tagihan bulanan, pantau jatuh tempo, dan cek total pembayaran penyewa dari satu tampilan.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="glass-panel rounded-3xl border border-emerald-200 px-5 py-4 text-emerald-700">{{ session('success') }}</div>
            @endif
            @if(session('info'))
                <div class="glass-panel rounded-3xl border border-slate-200 px-5 py-4 text-slate-700">{{ session('info') }}</div>
            @endif

            <section class="glass-panel rounded-[2rem] p-6 sm:p-8">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Generate Otomatis</p>
                        <h3 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">Buat tagihan baru untuk seluruh kontrak aktif</h3>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Sistem akan membuat tagihan bulan berjalan dan mencegah duplikasi untuk kontrak yang sudah memiliki tagihan pada periode yang sama.</p>
                    </div>

                    <form action="{{ route('pemilik.bills.generate') }}" method="POST" onsubmit="return confirm('Generate tagihan untuk bulan ini?');">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-gradient-to-r from-red-700 via-red-600 to-red-500 px-5 py-3 text-sm font-bold text-white shadow-[0_18px_35px_-18px_rgba(127,29,29,0.8)] transition hover:-translate-y-0.5">
                            Buat Tagihan Bulan Ini
                        </button>
                    </form>
                </div>
            </section>

            <section class="overflow-x-auto">
                <table class="data-table w-full text-sm">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Penyewa</th>
                            <th>Kamar</th>
                            <th class="text-right">Tagihan Utama</th>
                            <th class="text-right">Denda</th>
                            <th class="text-right">Total Bayar</th>
                            <th class="text-center">Jatuh Tempo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        @php
                            $totalBayar = $bill->amount + $bill->fine;
                        @endphp
                        <tr class="bg-white/85 transition hover:bg-red-50/60">
                            <td class="font-semibold text-red-700">{{ \Carbon\Carbon::createFromDate($bill->period_year, $bill->period_month, 1)->translatedFormat('F Y') }}</td>
                            <td class="font-medium text-slate-900">{{ $bill->contract->tenant->user->name }}</td>
                            <td class="text-slate-600">{{ $bill->contract->room->room_number }}</td>
                            <td class="text-right text-slate-700">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td class="text-right font-semibold text-red-600">Rp {{ number_format($bill->fine, 0, ',', '.') }}</td>
                            <td class="text-right font-bold text-slate-900">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                            <td class="text-center {{ \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($bill->due_date)) && $bill->status != 'lunas' ? 'font-bold text-red-700' : 'text-slate-600' }}">
                                {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                @if($bill->status == 'belum_bayar')
                                    <span class="badge-soft border-red-200 bg-red-50 text-red-700">Belum Bayar</span>
                                @elseif($bill->status == 'menunggu_konfirmasi')
                                    <span class="badge-soft border-amber-200 bg-amber-50 text-amber-700">Menunggu Konfirmasi</span>
                                @elseif($bill->status == 'lunas')
                                    <span class="badge-soft border-emerald-200 bg-emerald-50 text-emerald-700">Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('pemilik.bills.edit', $bill->id) }}" class="inline-flex rounded-full border border-red-200 px-4 py-2 font-semibold text-red-700 transition hover:bg-red-50">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-10 text-center text-slate-500">
                                Belum ada tagihan. Klik tombol "Buat Tagihan Bulan Ini" untuk memulai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</x-app-layout>
