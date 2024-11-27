<?php

namespace App\Services;

use Illuminate\Support\Collection;

class FoodReservationValidationService
{

    public function checkDataType(array $userInputData, array $allowedDaysForMonth, Collection $allowedFoodsForMonth, $isAlreadyReserved = false)
    {
        $dates = [];

//        if (! $isAlreadyReserved) {
            foreach ($userInputData as $item) {
                [$dates[],] = explode('*', $item);
            }
//        }

        if(array_diff($allowedDaysForMonth, $dates) !== []) {
            return false;
        }

        $foodData = @explode('*', $userInputData[0]);
        if(!isset ($foodData[1])) {
            return false;
        }

        if(! $allowedFoodsForMonth->where('foodID', $foodData[1])->first()){
            return false;
        }


        return true;
    }

}