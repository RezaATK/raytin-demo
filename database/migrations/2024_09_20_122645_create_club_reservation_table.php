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
        Schema::create('club_reservation', function (Blueprint $table) {
            $table->id('reservID');
            $table->unsignedBigInteger('userID')->nullable();
            $table->foreign('userID')->references('userID')->on('users')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('clubID')->nullable();
            $table->foreign('clubID')->references('clubID')->on('clubs')->nullOnDelete()->cascadeOnUpdate();
            $table->string('clubName');
            $table->string('genderSpecific')->nullable();
            $table->date('reservDate');
            $table->string('PrimaryUserName');
            $table->string('PrimaryUserLastName')->nullable();
            $table->string('primaryUserNationalCode');
            $table->string('primaryUserMobileNumber')->nullable();
            $table->string('secondayUserName')->nullable();
            $table->string('secondayUserLastName')->nullable();
            $table->string('secondayUserNationalCode')->nullable();
            $table->string('secondayUserRelationship');
            $table->string('secondayUserMobileNumber')->nullable();
            $table->string('secondayUserGender')->nullable();
            $table->unsignedBigInteger('trackingCode');
            $table->string('verification')->default('pending');
            $table->date('reserved_At')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_familymembers_ids');
    }
};
