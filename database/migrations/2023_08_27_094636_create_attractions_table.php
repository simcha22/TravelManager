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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('opening_time');
            $table->time('closing_time');
            $table->date('preferred_visiting_day')->nullable();
            $table->time('preferred_visiting_time')->nullable();
            $table->integer('visiting_hours')->nullable();
            $table->text('description');
            $table->string('address');
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
        Schema::dropIfExists('attractions');
    }
};
