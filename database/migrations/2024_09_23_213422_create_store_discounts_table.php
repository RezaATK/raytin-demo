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
        Schema::create('store_discounts', function (Blueprint $table) {
            $table->id('discountID');
            $table->unsignedBigInteger('userID')->nullable();
            $table->foreign('userID')->references('userID')->on('users');
            $table->date('discountDate');
            $table->unsignedBigInteger('storeID')->nullable();
            $table->foreign('storeID')->references('storeID')->on('stores');
            $table->string('storeName');
            $table->string('UserName')->nullable();
            $table->string('UserLastName')->nullable();
            $table->string('UserNationalCode')->nullable();
            $table->string('UserMobileNumber')->nullable();
            $table->string('UserEmployeeID');
            $table->string('UserEmploymentTypeName')->nullable();
            $table->string('UserUnitName')->nullable();
            $table->unsignedBigInteger('trackingCode');
            $table->string('verification_one');
            $table->string('verification_two')->nullable();
            $table->string('verification_three')->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('additionalNote')->nullable();
            $table->string('current_verification_state')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_discounts');
    }
};
