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
            $table->string('booking_unique_id');
            $table->enum('status', ['pending', 'complete'])->default('pending');
            $table->string('trip');
            $table->string('source');
            $table->text('stops')->nullable();
            $table->string('destination');
            $table->string('price');
            $table->string('paid_price_percentage');
            $table->string('balance_price');
            $table->string('passengers');
            $table->string('bags');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('alternate_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('ride_date');
            $table->string('ride_time');
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
