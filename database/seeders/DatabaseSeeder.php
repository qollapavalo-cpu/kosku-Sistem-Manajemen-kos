<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'pemilik@kosku.com',
        ], [
            'name' => 'Pemilik Kos',
            'password' => Hash::make('password'),
            'role' => 'pemilik',
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate([
            'email' => 'penyewa@kosku.com',
        ], [
            'name' => 'Penyewa Demo',
            'password' => Hash::make('password'),
            'role' => 'penyewa',
            'email_verified_at' => now(),
        ]);
    }
}
