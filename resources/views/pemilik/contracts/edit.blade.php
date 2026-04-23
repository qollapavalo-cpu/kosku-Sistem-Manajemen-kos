<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Kontrak Sewa') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
                @endif

                <form action="{{ route('pemilik.contracts.update', $contract->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Pilih Penyewa <span class="text-red-500">*</span></label>
                            <select name="tenant_id" class="w-full border rounded p-2 focus:ring" required>
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->id }}" {{ old('tenant_id', $contract->tenant_id) == $tenant->id ? 'selected' : '' }}>
                                        {{ $tenant->user->name }} (NIK: {{ $tenant->nik }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Pilih Kamar <span class="text-red-500">*</span></label>
                            <select name="room_id" class="w-full border rounded p-2 focus:ring" required>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id', $contract->room_id) == $room->id ? 'selected' : '' }}>
                                        Kamar {{ $room->room_number }} - {{ $room->roomType->name }}
                                        {{ $room->status === 'kosong' || $room->id === $contract->room_id ? '' : '(Tidak tersedia)' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Tanggal Mulai Masuk <span class="text-red-500">*</span></label>
                            <input type="date" name="start_date" class="w-full border rounded p-2" value="{{ old('start_date', $contract->start_date) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Durasi Sewa (Bulan) <span class="text-red-500">*</span></label>
                            <input type="number" name="duration_month" class="w-full border rounded p-2" value="{{ old('duration_month', $contract->duration_month) }}" min="1" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Harga Deal Per Bulan (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="monthly_price" class="w-full border rounded p-2" value="{{ old('monthly_price', $contract->monthly_price) }}" min="0" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Status Kontrak <span class="text-red-500">*</span></label>
                            <select name="status" class="w-full border rounded p-2 focus:ring" required>
                                <option value="aktif" {{ old('status', $contract->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ old('status', $contract->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ old('status', $contract->status) === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded">Update Kontrak</button>
                        <a href="{{ route('pemilik.contracts.index') }}" class="text-gray-500 hover:text-gray-800 font-semibold py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
