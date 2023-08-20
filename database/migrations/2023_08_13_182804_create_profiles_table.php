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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->integer('phone');
            $table->date('birthday');
            $table->enum('gender',['male', 'female', 'other']);
            $table->foreignId('country_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('address');
            $table->foreignId('plan_id')->constrained();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
