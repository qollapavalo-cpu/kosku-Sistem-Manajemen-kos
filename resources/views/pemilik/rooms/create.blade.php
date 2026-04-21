<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('pemilik.rooms.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Kamar <span class="text-red-500">*</span></label>
                            <select name="room_type_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Pilih Tipe Kamar --</option>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('room_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }} (Rp {{ number_format($type->monthly_price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Kamar <span class="text-red-500">*</span></label>
                            <input type="text" name="room_number" value="{{ old('room_number') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" placeholder="Contoh: A01" required>
                            @error('room_number') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Lantai <span class="text-red-500">*</span></label>
                            <input type="number" name="floor" value="{{ old('floor') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" min="1" placeholder="Contoh: 1" required>
                            @error('floor') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Kamar (Opsional)</label>
                            <input type="file" name="photo" class="shadow border rounded w-full py-2 px-3 text-gray-700" accept="image/*">
                            @error('photo') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Simpan Data</button>
                            <a href="{{ route('pemilik.rooms.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>