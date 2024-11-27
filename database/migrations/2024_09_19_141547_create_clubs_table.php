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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id('clubID');
            $table->unsignedBigInteger('clubCategoryID');
            $table->foreign('clubCategoryID')->references('clubCategoryID')->on('clubcategory')->cascadeOnDelete();
            $table->string('clubName');
            $table->string('clubDetails');
            $table->string('clubImage')->default('');
            $table->string('clubAddress')->nullable();
            $table->string('clubNeighborhood')->nullable();
            $table->string('genderSpecific')->nullable();
            $table->integer('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
