<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tagihan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-6 text-gray-600">Berikut adalah daftar tagihan bulanan Anda. Mohon lakukan pembayaran sebelum tanggal jatuh tempo untuk menghindari denda.</p>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-blue-50">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Bulan Tagihan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Kamar</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Biaya Sewa</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Denda</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Total Tagihan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Jatuh Tempo</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bills as $bill)
                                @php
                                    $totalBayar = $bill->amount + $bill->fine;
                                    $isOverdue = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($bill->due_date));
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2 font-bold">{{ \Carbon\Carbon::parse($bill->created_at)->format('F Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Kamar {{ $bill->contract->room->room_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right text-red-500">Rp {{ number_format($bill->fine, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right font-bold text-blue-700">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center {{ $isOverdue && $bill->status != 'lunas' ? 'text-red-600 font-bold' : '' }}">
                                        {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if($bill->status == 'belum_dibayar')
                                            <span class="bg-red-200 text-red-800 py-1 px-2 rounded-full text-xs font-bold">Belum Bayar</span>
                                        @elseif($bill->status == 'menunggu_konfirmasi')
                                            <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded-full text-xs font-bold">Menunggu Validasi</span>
                                        @elseif($bill->status == 'lunas')
                                            <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full text-xs font-bold">Lunas</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if($bill->status == 'belum_dibayar' || ($bill->status == 'menunggu_konfirmasi' && !$bill->proof_of_payment))
                                            <button class="bg-blue-300 text-white font-bold py-1 px-3 rounded text-xs cursor-not-allowed" title="Menunggu Fitur 8">Bayar</button>
                                        @else
                                            <span class="text-xs text-gray-500 italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="border border-gray-300 px-4 py-8 text-center text-gray-500 italic">
                                        Hore! Anda tidak memiliki tagihan saat ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>