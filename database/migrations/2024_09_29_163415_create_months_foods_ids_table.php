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
        Schema::create('months_foods_ids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('monthID');
            $table->unsignedBigInteger('foodID');
            $table->foreign('monthID')->references('monthID')->on('months');
            $table->foreign('foodID')->references('foodID')->on('foods')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('months_foods_ids');
    }
};
