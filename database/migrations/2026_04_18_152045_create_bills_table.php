<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained('contracts')->cascadeOnDelete();
            
            $table->tinyInteger('period_month');
            $table->smallInteger('period_year');
            $table->decimal('amount', 10, 2);
            $table->decimal('fine', 10, 2)->default(0);
            $table->date('due_date');
            $table->enum('status', ['belum_bayar', 'menunggu_konfirmasi', 'lunas'])->default('belum_bayar');
            $table->timestamps();

            // Unique key agar tidak ada tagihan ganda di bulan & tahun yang sama pada satu kontrak
            $table->unique(['contract_id', 'period_month', 'period_year'], 'uk_bill_period');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};