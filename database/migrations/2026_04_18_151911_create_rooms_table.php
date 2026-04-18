<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            
            // Foreign Key ke tabel room_types
            $table->foreignId('room_type_id')->constrained('room_types')->cascadeOnDelete(); 
            
            $table->string('room_number', 10)->unique(); // room_number VARCHAR(10) UNIQUE NOT NULL
            $table->integer('floor'); // floor INT NOT NULL
            $table->enum('status', ['kosong', 'terisi', 'maintenance'])->default('kosong');
            $table->string('photo', 255)->nullable(); // photo VARCHAR(255)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};