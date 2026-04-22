<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Kontrak Sewa') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                
                <div class="border-b pb-4 mb-4 flex justify-between items-center">
                    <h3 class="text-2xl font-bold text-gray-800">Kontrak #{{ str_pad($contract->id, 4, '0', STR_PAD_LEFT) }}</h3>
                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full font-bold text-sm">Status: {{ strtoupper($contract->status) }}</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <h4 class="font-bold text-lg border-b pb-2 mb-2 text-blue-600">Informasi Penyewa</h4>
                        <p class="mb-1"><span class="font-semibold">Nama:</span> {{ $contract->tenant->user->name }}</p>
                        <p class="mb-1"><span class="font-semibold">NIK:</span> {{ $contract->tenant->nik }}</p>
                        <p class="mb-1"><span class="font-semibold">No. HP:</span> {{ $contract->tenant->phone }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <h4 class="font-bold text-lg border-b pb-2 mb-2 text-blue-600">Informasi Kamar</h4>
                        <p class="mb-1"><span class="font-semibold">Nomor:</span> Kamar {{ $contract->room->room_number }}</p>
                        <p class="mb-1"><span class="font-semibold">Tipe:</span> {{ $contract->room->roomType->name }}</p>
                        <p class="mb-1"><span class="font-semibold">Lantai:</span> {{ $contract->room->floor }}</p>
                    </div>

                    <div class="md:col-span-2 bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <h4 class="font-bold text-lg border-b border-blue-200 pb-2 mb-2 text-blue-700">Detail Kesepakatan</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Masuk</p>
                                <p class="font-bold">{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Keluar</p>
                                <p class="font-bold">{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Durasi</p>
                                <p class="font-bold">{{ $contract->duration_month }} Bulan</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Biaya Bulanan</p>
                                <p class="font-bold text-green-600">Rp {{ number_format($contract->monthly_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t text-right">
                    <a href="{{ route('pemilik.contracts.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded">Kembali</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>