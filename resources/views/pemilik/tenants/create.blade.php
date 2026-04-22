<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tambah Penyewa Baru') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pemilik.tenants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Email (untuk Login)</label>
                        <input type="email" name="email" class="w-full border rounded p-2" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">NIK</label>
                        <input type="text" name="nik" class="w-full border rounded p-2" value="{{ old('nik') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">No. HP</label>
                        <input type="text" name="phone" class="w-full border rounded p-2" value="{{ old('phone') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Alamat</label>
                        <textarea name="address" class="w-full border rounded p-2">{{ old('address') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block font-bold">Foto KTP</label>
                        <input type="file" name="ktp_photo" class="w-full">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan & Buat Akun</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>