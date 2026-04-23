<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Konfirmasi Pembayaran') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-6">
                    <p class="text-sm"><strong>Penyewa:</strong> {{ $bill->contract->tenant->user->name }}</p>
                    <p class="text-sm"><strong>Kamar:</strong> {{ $bill->contract->room->room_number }} ({{ $bill->contract->room->roomType->name }})</p>
                    <p class="text-sm"><strong>Periode:</strong> {{ \Carbon\Carbon::createFromDate($bill->period_year, $bill->period_month, 1)->translatedFormat('F Y') }}</p>
                </div>

                <form action="{{ route('pemilik.payments.update', $bill->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-bold mb-2">Jumlah Tagihan (Rp) <span class="text-red-500">*</span></label>
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
                            <label class="block font-bold mb-2">Status Pembayaran <span class="text-red-500">*</span></label>
                            <select name="status" class="w-full border rounded p-2" required>
                                <option value="belum_bayar" {{ old('status', $bill->status) === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="menunggu_konfirmasi" {{ old('status', $bill->status) === 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="lunas" {{ old('status', $bill->status) === 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block font-bold mb-2">Bukti Pembayaran</label>
                        @if($bill->proof_of_payment)
                            <a href="{{ asset('storage/' . $bill->proof_of_payment) }}" target="_blank" class="text-blue-500 hover:underline">Lihat bukti transfer</a>
                            <label class="flex items-center mt-3 gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="clear_proof" value="1">
                                Hapus bukti pembayaran saat ini
                            </label>
                        @else
                            <p class="text-sm text-gray-500 italic">Belum ada bukti pembayaran yang diunggah.</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Konfirmasi</button>
                        <a href="{{ route('pemilik.payments.index') }}" class="text-sm text-gray-500 hover:text-gray-800">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
