<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Export Data Pendapatan</h3>
                    <p class="text-sm text-gray-600 mb-6">Pilih rentang tanggal berdasarkan waktu konfirmasi pembayaran (Lunas). Data akan diunduh dalam format .CSV yang dapat dibuka di Microsoft Excel.</p>

                    <form action="{{ route('pemilik.reports.export') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block font-bold text-sm mb-2">Dari Tanggal</label>
                                <input type="date" name="start_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block font-bold text-sm mb-2">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow transition duration-150">
                                📥 Download Laporan (CSV)
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Tips:</strong> Untuk membuka file CSV di Excel agar kolomnya langsung rapi, gunakan fitur "Data -> From Text/CSV" di dalam Excel dan pilih koma sebagai pemisahnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>