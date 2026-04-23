<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Kelola Penyewa') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <a href="{{ route('pemilik.tenants.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ Tambah Penyewa</a>
                
                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">NIK</th>
                            <th class="border p-2">No. HP</th>
                            <th class="border p-2">Foto KTP</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tenants as $tenant)
                        <tr>
                            <td class="border p-2">{{ $tenant->user->name }}</td>
                            <td class="border p-2">{{ $tenant->user->email }}</td>
                            <td class="border p-2">{{ $tenant->nik }}</td>
                            <td class="border p-2">{{ $tenant->phone }}</td>
                            <td class="border p-2 text-center">
                                @if($tenant->ktp_photo)
                                    <a href="{{ asset('storage/' . $tenant->ktp_photo) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Foto</a>
                                @else
                                    <span class="text-gray-400">Belum ada</span>
                                @endif
                            </td>
                            <td class="border p-2 text-center">
                                @if($tenant->user->email_verified_at)
                                    <span class="bg-green-200 text-green-800 py-1 px-2 rounded text-xs font-semibold">Terkonfirmasi</span>
                                @else
                                    <span class="bg-yellow-200 text-yellow-800 py-1 px-2 rounded text-xs font-semibold">Belum</span>
                                @endif
                            </td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('pemilik.tenants.edit', $tenant->id) }}" class="text-blue-500">Edit</a> |
                                <form action="{{ route('pemilik.tenants.destroy', $tenant->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus penyewa akan menghapus akun loginnya juga. Lanjut?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="border p-4 text-center text-gray-500">Belum ada data penyewa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
