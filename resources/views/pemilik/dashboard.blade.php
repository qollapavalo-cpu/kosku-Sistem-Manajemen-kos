<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pemilik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-blue-600 mb-2">Selamat Datang Bapak Kos!</h3>
                    <p class="text-gray-600">Ini adalah pusat kendali utama untuk mengelola Kosku. Anda bisa memantau kamar, melihat tagihan, dan mengonfirmasi pembayaran di sini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                    <div class="p-6">
                        <h4 class="font-bold text-lg mb-2">Tipe Kamar</h4>
                        <p class="text-sm text-gray-500 mb-4">Atur harga, fasilitas, dan jenis kamar kos Anda.</p>
                        <a href="{{ route('pemilik.room-types.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded text-sm transition duration-150">
                            Kelola Tipe Kamar &rarr;
                        </a>
                    </div>
                </div>

                </div>

        </div>
    </div>
</x-app-layout>