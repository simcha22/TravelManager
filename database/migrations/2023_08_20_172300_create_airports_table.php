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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('iata_code');
            $table->string('icao_code');
            $table->foreignId('country_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->string('street_number');
            $table->string('street');
            $table->string('city');
            $table->string('county');
            $table->string('country');
            $table->string('country_iso');
            $table->string('postal_code');
            $table->string('phone');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('uct');
            $table->string('website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
