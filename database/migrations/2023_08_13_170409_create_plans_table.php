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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('count_of_users');
            $table->integer('count_of_groups');
            $table->integer('count_of_travels');
            $table->integer('count_of_advertisements');
            $table->integer('count_of_tracks');
            $table->integer('count_of_documents');
            $table->enum('type_of_calk',['monthly', 'yearly', 'lifetime']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
