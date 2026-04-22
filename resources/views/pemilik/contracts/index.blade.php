<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Kelola Kontrak Sewa') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <a href="{{ route('pemilik.contracts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ Buat Kontrak Baru</a>
                
                <table class="w-full border-collapse border border-gray-300 mt-4 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Penyewa</th>
                            <th class="border p-2">Kamar</th>
                            <th class="border p-2">Mulai</th>
                            <th class="border p-2">Selesai</th>
                            <th class="border p-2">Durasi</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contracts as $contract)
                        <tr>
                            <td class="border p-2 font-semibold">{{ $contract->tenant->user->name }}</td>
                            <td class="border p-2">{{ $contract->room->room_number }} ({{ $contract->room->roomType->name }})</td>
                            <td class="border p-2">{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</td>
                            <td class="border p-2">{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</td>
                            <td class="border p-2 text-center">{{ $contract->duration_month }} Bulan</td>
                            <td class="border p-2 text-center">
                                @if($contract->status == 'aktif')
                                    <span class="bg-green-200 text-green-800 py-1 px-2 rounded text-xs">Aktif</span>
                                @else
                                    <span class="bg-gray-200 text-gray-800 py-1 px-2 rounded text-xs">{{ ucfirst($contract->status) }}</span>
                                @endif
                            </td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('pemilik.contracts.show', $contract->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white py-1 px-3 rounded text-xs">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="border p-4 text-center text-gray-500">Belum ada data kontrak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>