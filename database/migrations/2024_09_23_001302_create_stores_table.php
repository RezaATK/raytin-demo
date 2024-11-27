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
        Schema::create('stores', function (Blueprint $table) {
            $table->id('storeID');
            $table->string('storeName');
            $table->text('storeDetails')->nullable();
            $table->text('storeTerms')->nullable();
            $table->string('storeImage')->nullable();
            $table->text('storeAddress')->nullable();
            $table->string('storeNeighborhood')->nullable();
            $table->unsignedBigInteger('storeCategoryID');
            $table->foreign('storeCategoryID')->references('storeCategoryID')->on('storecategory')->onUpdate('cascade');
            $table->integer('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
