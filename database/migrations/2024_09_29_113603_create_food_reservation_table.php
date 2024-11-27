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
        Schema::create('food_reservation', function (Blueprint $table) {
            $table->id('reservID');

            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onUpdate('cascade');

            $table->date('reservDate')->index();
            $table->unsignedBigInteger('foodID');
            $table->foreign('foodID')->references('foodID')->on('foods')->onUpdate('cascade');

            $table->unsignedBigInteger('monthID');
            $table->foreign('monthID')->references('monthID')->on('months')->onUpdate('cascade');

            $table->decimal('foodPrice',10,0);

            $table->unsignedBigInteger('foodCategoryID');
            $table->foreign('foodCategoryID')->references('foodCategoryID')->on('foodcategory')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_reservation');
    }
};
