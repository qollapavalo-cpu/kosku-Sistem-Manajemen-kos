<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Tipe Kamar') }}
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
                    <a href="{{ route('pemilik.room-types.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        + Tambah Tipe Kamar
                    </a>

                    <table class="w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border border-gray-300 px-4 py-2">Nama</th>
                                <th class="border border-gray-300 px-4 py-2">Fasilitas</th>
                                <th class="border border-gray-300 px-4 py-2">Harga / Bulan</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roomTypes as $type)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $type->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $type->facilities }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($type->monthly_price, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <span class="text-gray-400 italic">Belum dibuat</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
