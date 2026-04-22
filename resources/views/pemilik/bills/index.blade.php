<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Kelola Tagihan Bulanan') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">{{ session('info') }}</div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Klik tombol di sebelah kanan untuk membuat tagihan otomatis bagi semua penyewa yang kontraknya masih aktif bulan ini.</p>
                    
                    <form action="{{ route('pemilik.bills.generate') }}" method="POST" onsubmit="return confirm('Generate tagihan untuk bulan ini?');">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded shadow">
                            ⚡ Buat Tagihan Bulan Ini
                        </button>
                    </form>
                </div>
                
                <table class="w-full border-collapse border border-gray-300 mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2 text-left">Bulan</th>
                            <th class="border p-2 text-left">Penyewa</th>
                            <th class="border p-2 text-left">Kamar</th>
                            <th class="border p-2 text-right">Tagihan Utama</th>
                            <th class="border p-2 text-right">Denda</th>
                            <th class="border p-2 text-right">Total Bayar</th>
                            <th class="border p-2 text-center">Jatuh Tempo</th>
                            <th class="border p-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                        @php
                            $totalBayar = $bill->amount + $bill->fine;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2 font-semibold text-blue-600">{{ \Carbon\Carbon::parse($bill->created_at)->format('F Y') }}</td>
                            <td class="border p-2">{{ $bill->contract->tenant->user->name }}</td>
                            <td class="border p-2">{{ $bill->contract->room->room_number }}</td>
                            <td class="border p-2 text-right">Rp {{ number_format($bill->amount, 0, ',', '.') }}</td>
                            <td class="border p-2 text-right text-red-500">Rp {{ number_format($bill->fine, 0, ',', '.') }}</td>
                            <td class="border p-2 text-right font-bold">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                            <td class="border p-2 text-center {{ \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($bill->due_date)) && $bill->status != 'lunas' ? 'text-red-600 font-bold' : '' }}">
                                {{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}
                            </td>
                            <td class="border p-2 text-center">
                                @if($bill->status == 'belum_dibayar')
                                    <span class="bg-red-200 text-red-800 py-1 px-2 rounded-full text-xs font-bold">Belum Bayar</span>
                                @elseif($bill->status == 'menunggu_konfirmasi')
                                    <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded-full text-xs font-bold">Menunggu Konfirmasi</span>
                                @elseif($bill->status == 'lunas')
                                    <span class="bg-green-200 text-green-800 py-1 px-2 rounded-full text-xs font-bold">Lunas</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="border p-6 text-center text-gray-500">
                                Belum ada tagihan. Klik tombol "Buat Tagihan Bulan Ini" untuk memulai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>