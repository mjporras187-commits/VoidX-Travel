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
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->string('destination');    // Pangalan ng package (e.g., Boracay Getaway)
            $table->string('location');       // City/Country (e.g., Aklan, Philippines)
            $table->decimal('price', 10, 2);  // Presyo na may decimal (e.g., 5000.00)
            $table->text('description');      // Detalye o itinerary
            $table->timestamps();             // created_at at updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};