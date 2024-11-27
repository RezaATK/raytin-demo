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
        Schema::create('foods', function (Blueprint $table) {
            $table->id('foodID');
            $table->string('foodName');
            $table->text('foodDetails');
            $table->string('foodImage');
            $table->decimal('foodPrice',10,0);
            $table->unsignedBigInteger('foodCategoryID');
            $table->foreign('foodCategoryID')->references('foodCategoryID')->on('foodcategory')->onUpdate('cascade');
            $table->integer('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
