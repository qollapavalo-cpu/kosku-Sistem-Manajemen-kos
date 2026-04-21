<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Kamar') }}
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
                    
                    <a href="{{ route('pemilik.rooms.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        + Tambah Kamar
                    </a>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 mt-4">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">Foto</th>
                                    <th class="border border-gray-300 px-4 py-2">No. Kamar</th>
                                    <th class="border border-gray-300 px-4 py-2">Tipe Kamar</th>
                                    <th class="border border-gray-300 px-4 py-2">Lantai</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rooms as $room)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if($room->photo)
                                            <img src="{{ asset('storage/' . $room->photo) }}" alt="Foto Kamar" class="h-16 w-16 object-cover rounded mx-auto">
                                        @else
                                            <span class="text-xs text-gray-500">Tanpa Foto</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 font-bold">{{ $room->room_number }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $room->roomType->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $room->floor }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if($room->status == 'kosong')
                                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs font-semibold">Kosong</span>
                                        @elseif($room->status == 'terisi')
                                            <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs font-semibold">Terisi</span>
                                        @else
                                            <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs font-semibold">Maintenance</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <a href="{{ route('pemilik.rooms.edit', $room->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                        
                                        <form action="{{ route('pemilik.rooms.destroy', $room->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Belum ada data kamar.</td>
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