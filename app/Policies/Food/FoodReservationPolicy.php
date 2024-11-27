<?php

namespace App\Policies\Food;

use App\Models\User\User;

class FoodReservationPolicy
{
    private const FoodReservationReserve = 'foodreservation:reserve';

    private const FoodReservationSTATS = 'foodstats:stats';

    private const FoodReservationMyReservations = 'foodreservation:myreservations';


    const RESERVE = 'reserve';

    const MYRESERVATIONS = 'myreservations';

    const STATS = 'stats';



    public function reserve(User $user): bool
    {
        return $user->can(self::FoodReservationReserve);
    }


    public function myreservations(User $user): bool
    {
        return $user->can(self::FoodReservationSTATS);
    }


    public function stats(User $user): bool
    {
        return $user->can(self::FoodReservationMyReservations);
    }

}
