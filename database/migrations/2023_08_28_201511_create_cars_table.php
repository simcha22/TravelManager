<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Car Rental name');
            $table->string('address')->comment('Car Rental address');
            $table->text('description');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('travel_id')->constrained('travels', 'id');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->dateTime('Preferred_arriving_time')->nullable();
            $table->dateTime('Preferred_returning_time')->nullable();
            $table->integer('number_of_days');
            $table->timestamps();
            $table->softDeletes();
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
