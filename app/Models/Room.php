<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['room_type_id', 'room_number', 'floor', 'status', 'photo'];

    // Relasi: 1 Kamar dimiliki oleh 1 Tipe Kamar
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    // Relasi: 1 Kamar bisa memiliki banyak Kontrak (riwayat)
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}