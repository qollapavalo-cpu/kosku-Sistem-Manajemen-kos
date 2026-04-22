<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembayaran Masuk') }}
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
                    <p class="mb-6 text-gray-600 italic">Daftar tagihan di bawah ini adalah yang sudah dibayar oleh penyewa dan menunggu validasi bukti transfer dari Anda.</p>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2 text-left">Penyewa</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Kamar</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Bulan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Total Tagihan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Bukti Transfer</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingPayments as $bill)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 font-semibold">{{ $bill->contract->tenant->user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $bill->contract->room->room_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($bill->created_at)->format('F Y') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right font-bold">Rp {{ number_format($bill->amount + $bill->fine, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if($bill->proof_of_payment)
                                            <a href="{{ asset('storage/' . $bill->proof_of_payment) }}" target="_blank" class="text-blue-500 hover:underline text-xs">Lihat Bukti Full &rarr;</a>
                                        @else
                                            <span class="text-red-500 text-xs italic">Bukti Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <form action="{{ route('pemilik.payments.approve', $bill->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs" onclick="return confirm('Apakah Anda yakin bukti transfer sudah benar dan sesuai?')">
                                                    Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('pemilik.payments.reject', $bill->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs" onclick="return confirm('Tolak pembayaran ini?')">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-8 text-center text-gray-500 italic">
                                        Tidak ada konfirmasi pembayaran masuk saat ini.
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