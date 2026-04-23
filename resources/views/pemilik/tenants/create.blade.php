<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Penyewa Baru') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('pemilik.tenants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Email (untuk Login)</label>
                        <input type="email" name="email" class="w-full border rounded p-2" value="{{ old('email') }}" required>
                        <p class="text-xs text-gray-500 mt-1">Email ini akan menjadi username login penyewa.</p>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">No. HP</label>
                        <input type="text" name="phone" class="w-full border rounded p-2" value="{{ old('phone') }}" required>
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded p-2" value="{{ old('nik') }}" required>
                        @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                        <p class="text-xs text-gray-500 mt-1">Minimal 8 karakter.</p>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Alamat</label>
                        <textarea name="address" class="w-full border rounded p-2">{{ old('address') }}</textarea>
                        @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Foto KTP</label>
                        <input type="file" name="ktp_photo" class="w-full border rounded p-2" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                        <p class="text-xs text-gray-500 mt-1">Format JPG/JPEG/PNG, maksimal 2MB.</p>
                        @error('ktp_photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Akun penyewa akan langsung aktif dan bisa login memakai email serta password yang Anda input di form ini.</p>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan & Buat Akun</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
