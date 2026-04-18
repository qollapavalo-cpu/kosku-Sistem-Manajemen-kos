<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            
            // Foreign Key ke tabel users (user_id BIGINT UNSIGNED UNIQUE NOT NULL)
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            
            $table->string('nik', 20)->unique(); // nik VARCHAR(20) UNIQUE NOT NULL
            $table->string('phone', 20); // phone VARCHAR(20) NOT NULL
            $table->text('address')->nullable(); // address TEXT
            $table->string('ktp_photo', 255)->nullable(); // ktp_photo VARCHAR(255)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};