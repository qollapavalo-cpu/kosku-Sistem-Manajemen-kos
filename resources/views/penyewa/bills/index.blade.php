<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-red-700">Tagihan Saya</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900">{{ __('Daftar Tagihan Penyewa') }}</h2>
            </div>
            <p class="max-w-xl text-sm leading-6 text-slate-500">Periksa nominal, jatuh tempo, denda, dan lanjut ke pembayaran dari tampilan yang lebih jelas.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="glass-panel rounded-3xl border border-emerald-200 px-5 py-4 text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="glass-panel rounded-3xl border border-slate-200 px-5 py-4 text-slate-700">
                    {{ session('info') }}
                </div>
            @endif

            <section class="glass-panel rounded-[2rem] p-6 sm:p-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Status Pembayaran</p>
                        <h3 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">Cek tagihan sebelum jatuh tempo</h3>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Total yang tampil di bawah sudah termasuk denda yang tercatat pada tagihan Anda. Segera lakukan pembayaran agar tidak terlambat.</p>
                    </div>
                    <div class="rounded-[1.5rem] border border-red-100 bg-gradient-to-br from-red-50 to-white px-5 py-4">
                        <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-700">Pengingat</p>
                        <p class="mt-2 max-w-xs text-sm leading-6 text-slate-600">Setelah transfer, unggah bukti pembayaran yang jelas agar validasi pemilik lebih cepat.</p>
                    </div>
                </div>
            </section>

            <section class="overflow-x-auto">
                <table class="data-table w-full">
                    <thead>
                        <tr>
                            <th>Bulan Tagihan</th>
                            <th>Kamar</th>
                            <th class="text-right">Biaya Sewa</th>
                            <th class="text-right">Denda</th>
                            <th class="text-right">Total Tagihan</th>
                            <th class="text-center">Jatuh Tempo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        @php
                            $totalBayar = $bill->amount + $bill->fine;
                            $isOverdue = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($bill->due_date));
                        @endphp
                        <tr class="bg-white/85 transition hover:bg-red-50/60">
                            <td class="font-bold text-slate-900">{{ \Carbon\Carbon::createFromDate($bill->period_year, $bill->period_month, 1)->translatedFormat('F Y') }}</td>
                            <td class="text-slate-600">Kamar {{ $bill->contract->room->room_number }}</td>
                            <td class="text-right text-slate-700">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td class="text-right font-semibold text-red-600">Rp {{ number_format($bill->fine, 0, ',', '.') }}</td>
                            <td class="text-right font-bold text-red-700">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                            <td class="text-center {{ $isOverdue && $bill->status != 'lunas' ? 'font-bold text-red-700' : 'text-slate-600' }}">
                                {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                @if($bill->status == 'belum_bayar')
                                    <span class="badge-soft border-red-200 bg-red-50 text-red-700">Belum Bayar</span>
                                @elseif($bill->status == 'menunggu_konfirmasi')
                                    <span class="badge-soft border-amber-200 bg-amber-50 text-amber-700">Menunggu Validasi</span>
                                @elseif($bill->status == 'lunas')
                                    <span class="badge-soft border-emerald-200 bg-emerald-50 text-emerald-700">Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($bill->status == 'belum_bayar' || ($bill->status == 'menunggu_konfirmasi' && !$bill->proof_of_payment))
                                    <a href="{{ route('penyewa.payments.create', $bill->id) }}" class="inline-flex rounded-full bg-red-600 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-sm transition hover:bg-red-700">
                                        Bayar
                                    </a>
                                @else
                                    <span class="text-xs font-medium italic text-slate-500">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-10 text-center text-slate-500 italic">
                                Hore! Anda tidak memiliki tagihan saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</x-app-layout>
