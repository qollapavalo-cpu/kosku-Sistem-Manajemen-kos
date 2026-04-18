<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id(); // id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT [cite: 232]
            $table->string('name', 50); // name VARCHAR(50) NOT NULL [cite: 233]
            $table->text('description')->nullable(); // description TEXT [cite: 234]
            $table->text('facilities')->nullable(); // facilities TEXT [cite: 235]
            $table->decimal('monthly_price', 10, 2); // monthly_price DECIMAL(10,2) NOT NULL 
            $table->timestamps(); // created_at & updated_at [cite: 237]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};