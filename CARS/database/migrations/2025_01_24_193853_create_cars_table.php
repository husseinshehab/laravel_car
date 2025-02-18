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
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // Auto-incrementing car ID
            $table->string('name'); // Car name
            $table->string('model'); // Car model
            $table->year('year'); // Year of manufacture
            $table->integer('horsepower'); // Horsepower
            $table->integer('mileage'); // Mileage
            $table->decimal('price', 10, 2); // Price with 2 decimal points
            $table->timestamps(); // Created at and updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
