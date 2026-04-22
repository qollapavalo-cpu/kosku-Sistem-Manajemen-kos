<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController; // Wajib ditambahkan di paling atas
use App\Models\Bill;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Tenant;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\BillController;

Route::get('/', function () {
    return view('welcome');
});

// Redirect Dinamis Setelah Login
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'pemilik') {
        return redirect()->route('pemilik.dashboard');
    }
    return redirect()->route('penyewa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// GRUP ROUTE UNTUK PEMILIK (ADMIN)
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    /*
    Route::get('/dashboard', function () {
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'terisi')->count();
        $emptyRooms = Room::where('status', 'kosong')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();

        $activeContracts = Contract::where('status', 'aktif')->count();
        $totalTenants = Tenant::count();
        $roomTypesCount = RoomType::count();

        $unpaidBills = Bill::where('status', 'belum_bayar')->count();
        $pendingBills = Bill::where('status', 'menunggu_konfirmasi')->count();
        $paidBills = Bill::where('status', 'lunas')->count();

        $monthlyRevenue = Payment::whereYear('payment_date', now()->year)
            ->whereMonth('payment_date', now()->month)
            ->sum('amount');

        $outstandingAmount = Bill::whereIn('status', ['belum_bayar', 'menunggu_konfirmasi'])
            ->sum('amount');

        $recentContracts = Contract::with(['tenant.user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        $urgentBills = Bill::with(['contract.tenant.user', 'contract.room'])
            ->whereIn('status', ['belum_bayar', 'menunggu_konfirmasi'])
            ->orderBy('due_date')
            ->take(5)
            ->get();

        return view('pemilik.dashboard', compact(
            'totalRooms',
            'occupiedRooms',
            'emptyRooms',
            'maintenanceRooms',
            'activeContracts',
            'totalTenants',
            'roomTypesCount',
            'unpaidBills',
            'pendingBills',
            'paidBills',
            'monthlyRevenue',
            'outstandingAmount',
            'recentContracts',
            'urgentBills',
        )); 
    })->name('dashboard');

    // Route resource untuk Tipe Kamar dimasukkan ke sini
    */

    Route::get('/dashboard', function () {
        return view('pemilik.dashboard'); 
    })->name('dashboard');

    Route::resource('room-types', RoomTypeController::class);
    
    // Tambahkan route Kelola Kamar di sini
    Route::resource('rooms', RoomController::class);

    Route::resource('contracts', ContractController::class);

    Route::get('bills', [BillController::class, 'index'])->name('bills.index');
    Route::post('bills/generate', [BillController::class, 'generate'])->name('bills.generate');

    // ... dalam grup middleware pemilik ...
    Route::resource('tenants', TenantController::class);
    
});

// GRUP ROUTE UNTUK PENYEWA
Route::middleware(['auth', 'role:penyewa'])->prefix('penyewa')->name('penyewa.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('penyewa.dashboard'); 
    })->name('dashboard');

    
    
    
});

require __DIR__.'/auth.php';
