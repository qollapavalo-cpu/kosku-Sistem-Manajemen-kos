<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'contract_id', 'period_month', 'period_year', 
        'amount', 'fine', 'due_date', 'status'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    // Relasi: 1 Tagihan bisa memiliki banyak Pembayaran (misal jika ada cicilan/revisi),
    // atau jika Anda set 1 tagihan = 1 pembayaran lunas, bisa pakai hasOne. Kita pakai hasOne/hasMany.
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}