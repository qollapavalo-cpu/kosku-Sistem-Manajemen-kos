<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Penyewa') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pemilik.tenants.update', $tenant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name', $tenant->user->name) }}" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Email</label>
                        <input type="email" class="w-full border rounded p-2 bg-gray-100" value="{{ $tenant->user->email }}" disabled>
                        <p class="text-xs text-gray-500 mt-1">Email login saat ini tidak diubah dari halaman ini.</p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">No. HP</label>
                        <input type="text" name="phone" class="w-full border rounded p-2" value="{{ old('phone', $tenant->phone) }}" required>
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded p-2" value="{{ old('nik', $tenant->nik) }}" required>
                        @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Alamat</label>
                        <textarea name="address" class="w-full border rounded p-2">{{ old('address', $tenant->address) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Foto KTP</label>
                        <input type="file" name="ktp_photo" class="w-full border rounded p-2" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti foto. Format JPG/JPEG/PNG, maksimal 2MB.</p>
                        @error('ktp_photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if($tenant->ktp_photo)
                        <div class="mb-4">
                            <p class="block font-bold mb-2">Foto KTP Saat Ini</p>
                            <img src="{{ asset('storage/' . $tenant->ktp_photo) }}" alt="Foto KTP {{ $tenant->user->name }}" class="h-40 rounded border object-cover">
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Penyewa</button>
                        <a href="{{ route('pemilik.tenants.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
