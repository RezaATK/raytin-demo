<?php

namespace Database\Seeders;

use App\Models\Club\Club;
use App\Models\Club\ClubReservations;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClubReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($count): void
    {

        $users = User::all()->pluck('userID')->toArray();
        $clubs = Club::all()->pluck('clubID')->toArray();
        for ($i = 0; $i < $count; $i++) {
            $userID = fake()->randomElement($users);
            $user = User::query()->find($userID);
            $clubID = fake()->randomElement($clubs);
            $club = User::query()->find($clubID);
            ClubReservations::query()->create([
                'userID' => $userID,
                'clubID' => $clubID,
                'clubName' => $club->name,
                'genderSpecific' => 'آقایان و بانوان',
                'reservDate' => Carbon::now()->toDateString(),
                'PrimaryUserName' => $user->name,
                'PrimaryUserLastName' => $user->lastName,
                'primaryUserNationalCode' => $user->nationalCode,
                'primaryUserMobileNumber' => $user->mobileNumber,
                'secondayUserName' => $user->name,
                'secondayUserLastName' => $user->lastName,
                'secondayUserNationalCode' => $user->nationalCode,
                'secondayUserRelationship' => 'شخص کارمند',
                'secondayUserMobileNumber' => $user->mobileNumber,
                'secondayUserGender' => $user->gender,
                'trackingCode' => random_int(1111112212,9999999999),
                'verification' => fake()->randomElement(['pending', 'verified', 'rejected']),
                'reserved_At' => Carbon::now()->toDateString(),
            ]);
        }


    }
}
