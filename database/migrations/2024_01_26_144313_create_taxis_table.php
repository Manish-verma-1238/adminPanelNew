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
        Schema::create('taxis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('similar_cars')->nullable();
            $table->string('image');
            $table->unsignedBigInteger('passengers');
            $table->unsignedBigInteger('bags');
            $table->string('price');
            $table->enum('status', ['show', 'hide'])->default('show');
            $table->text('other_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxis');
    }
};
