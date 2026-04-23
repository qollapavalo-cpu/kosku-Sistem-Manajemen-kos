<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'tenant_id', 'room_id', 'start_date', 'end_date', 
        'duration_month', 'monthly_price', 'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'duration_month' => 'integer',
        'monthly_price' => 'decimal:2',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Relasi: 1 Kontrak memiliki banyak Tagihan Bulanan
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
