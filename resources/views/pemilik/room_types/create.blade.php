<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tipe Kamar Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('pemilik.room-types.store') }}" method="POST" id="room-type-form">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Nama Tipe Kamar <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                                placeholder="Contoh: Standar AC" required>
                            
                            @error('name') 
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="3" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                placeholder="Penjelasan singkat mengenai kamar ini">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="facilities">
                                Fasilitas
                            </label>
                            <textarea name="facilities" id="facilities" rows="3" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                placeholder="Contoh: Kasur, Lemari, AC, Kamar Mandi Dalam">{{ old('facilities') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="monthly_price">
                                Harga per Bulan (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="monthly_price" id="monthly_price" value="{{ old('monthly_price') }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('monthly_price') border-red-500 @enderror" 
                                placeholder="Contoh: 1500000" min="0" required>
                            
                            @error('monthly_price') 
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" id="submit-room-type" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                                Simpan Data
                            </button>
                            <a href="{{ route('pemilik.room-types.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                                Batal & Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('room-type-form');
            const submitButton = document.getElementById('submit-room-type');

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.textContent = 'Menyimpan...';
                submitButton.classList.add('opacity-75', 'cursor-not-allowed');
            });
        });
    </script>
</x-app-layout>
