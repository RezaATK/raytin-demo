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
        Schema::create('users_familymembers_ids', function (Blueprint $table) {
            $table->id('familyID');
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('employeeID');
            $table->string('familyMemberName');
            $table->string('familyMemberLastName');
            $table->string('familyMemberNationalCode');
            $table->string('familyMemberRelationship');
            $table->string('familyMemberMobileNumber');
            $table->date('familyMemberBirthday');
            $table->string('familyMemberGender');
            $table->timestamps();
//            'familyMemberName'
//            'familyMemberLastName'
//            'familyMemberNationalCode'
//            'familyMemberRelationship'
//            'familyMemberMobileNumber'
//            'familyMemberBirthday'
//            'familyMemberGender'
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
