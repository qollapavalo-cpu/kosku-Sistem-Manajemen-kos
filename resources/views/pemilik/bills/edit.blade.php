<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Tagihan') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pemilik.bills.update', $bill->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4 md:col-span-2">
                            <label class="block font-bold mb-2">Kontrak Aktif <span class="text-red-500">*</span></label>
                            <select name="contract_id" class="w-full border rounded p-2" required>
                                @foreach($contracts as $contract)
                                    <option value="{{ $contract->id }}" {{ old('contract_id', $bill->contract_id) == $contract->id ? 'selected' : '' }}>
                                        {{ $contract->tenant->user->name }} - Kamar {{ $contract->room->room_number }} ({{ $contract->room->roomType->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Bulan Tagihan <span class="text-red-500">*</span></label>
                            <select name="period_month" class="w-full border rounded p-2" required>
                                @for($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ (int) old('period_month', $bill->period_month) === $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::createFromDate(null, $month, 1)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Tahun Tagihan <span class="text-red-500">*</span></label>
                            <input type="number" name="period_year" class="w-full border rounded p-2" value="{{ old('period_year', $bill->period_year) }}" min="2000" max="2100" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Tagihan Utama (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="amount" class="w-full border rounded p-2" value="{{ old('amount', $bill->amount) }}" min="0" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Denda (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="fine" class="w-full border rounded p-2" value="{{ old('fine', $bill->fine) }}" min="0" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Jatuh Tempo <span class="text-red-500">*</span></label>
                            <input type="date" name="due_date" class="w-full border rounded p-2" value="{{ old('due_date', $bill->due_date) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Status <span class="text-red-500">*</span></label>
                            <select name="status" class="w-full border rounded p-2" required>
                                <option value="belum_bayar" {{ old('status', $bill->status) === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="menunggu_konfirmasi" {{ old('status', $bill->status) === 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="lunas" {{ old('status', $bill->status) === 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Tagihan</button>
                        <a href="{{ route('pemilik.bills.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
