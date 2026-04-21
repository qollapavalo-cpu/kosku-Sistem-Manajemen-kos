<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('pemilik.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Kamar <span class="text-red-500">*</span></label>
                            <select name="room_type_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type->id }}" {{ (old('room_type_id', $room->room_type_id) == $type->id) ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Kamar <span class="text-red-500">*</span></label>
                            <input type="text" name="room_number" value="{{ old('room_number', $room->room_number) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                            @error('room_number') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Lantai <span class="text-red-500">*</span></label>
                            <input type="number" name="floor" value="{{ old('floor', $room->floor) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status Kamar <span class="text-red-500">*</span></label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                <option value="kosong" {{ $room->status == 'kosong' ? 'selected' : '' }}>Kosong</option>
                                <option value="terisi" {{ $room->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                                <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Foto Kamar (Biarkan kosong jika tidak diganti)</label>
                            @if($room->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $room->photo) }}" class="h-24 w-24 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="photo" class="shadow border rounded w-full py-2 px-3 text-gray-700" accept="image/*">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Update Data</button>
                            <a href="{{ route('pemilik.rooms.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>