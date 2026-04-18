<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained('bills')->cascadeOnDelete();
            
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->string('proof_image', 255)->nullable();
            
            $table->timestamp('confirmed_at')->nullable();
            
            // Foreign Key ke tabel users (admin yang mengkonfirmasi)
            // Pakai nullOnDelete agar kalau admin dihapus, riwayat pembayaran tidak ikut terhapus
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};