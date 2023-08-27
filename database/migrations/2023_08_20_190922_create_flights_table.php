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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('airline_id')->constrained('airlines', 'id');
            $table->foreignId('airport_from_id')->constrained('airports', 'id');
            $table->foreignId('airport_to_id')->constrained('airports', 'id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->enum('type', ['away', 'return']);
            $table->string('place');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('travel_id')->constrained('travels', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
