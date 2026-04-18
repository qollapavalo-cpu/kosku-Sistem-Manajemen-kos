<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['user_id', 'nik', 'phone', 'address', 'ktp_photo'];

    // Relasi: 1 Profil Penyewa dimiliki oleh 1 Akun User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 Penyewa bisa memiliki banyak Kontrak (riwayat ngekos)
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}