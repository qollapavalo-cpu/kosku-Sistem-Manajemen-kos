<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role', // Tambahkan role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: 1 User (penyewa) punya 1 profil Tenant
    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    // Relasi: 1 User (admin) bisa mengkonfirmasi banyak pembayaran
    public function confirmedPayments()
    {
        return $this->hasMany(Payment::class, 'confirmed_by');
    }
}
