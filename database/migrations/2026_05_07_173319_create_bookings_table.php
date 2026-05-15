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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Sino ang nag-book?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Anong travel item ang binook? (nullable para safe)
            $table->unsignedBigInteger('travel_id')->nullable();

            // Ano ang binook?
            $table->string('item_name');
            $table->decimal('price', 15, 2);
            $table->integer('qty')->default(1);

            // Kailan ang biyahe?
            $table->date('travel_date')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};