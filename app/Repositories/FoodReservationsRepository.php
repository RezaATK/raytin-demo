<?php

namespace App\Repositories;

use App\Models\Food\FoodReservation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FoodReservationsRepository
{
    public function getFoodDataForMonth(int $monthID): Collection
    {
        // optimized hasMany relationship query for active foods in $monthID
        return DB::table('months_foods_ids')
                    ->join('foods', 'foods.foodID', '=', 'months_foods_ids.foodID')
                    ->join('foodcategory', 'foodcategory.foodCategoryID', '=', 'foods.foodCategoryID')
                    ->join('months', 'months_foods_ids.monthID', '=', 'months.monthID')
                    ->where('months.monthID', '=', $monthID)
                    ->where('foods.isActive', '=', 1)
                    ->select('months_foods_ids.foodID', 'foods.foodName', 'foods.foodPrice', 'foods.foodCategoryID', 'foodcategory.categoryName')
                    ->get();
    }



    public function getReservationsDataForMonth(array $startAndEndMonth, int $userID): Collection
    {
        return DB::table('food_reservation')
                    ->join('foods', 'foods.foodID', '=', 'food_reservation.foodID')
                    ->join('foodcategory', 'foodcategory.foodCategoryID', '=', 'foods.foodCategoryID')
                    ->where('food_reservation.userID', '=', $userID)
                    ->whereBetween('reservDate', [jalaliToGregorian($startAndEndMonth[0]), jalaliToGregorian($startAndEndMonth[1])])
                    ->orderBy('food_reservation.reservDate', 'ASC')
                    ->get();
    }

    public function createReservationsForMonth(Collection $reservesData, int $userID)
    {
        DB::Transaction(function () use ($reservesData, $userID) {
            foreach($reservesData as $reserve) {
                DB::table('food_reservation')->insert([
                    'userID' => $userID,
                    'reservDate' => $reserve['date'],
                    'monthID' => $reserve['monthID'],
                    'foodID' => $reserve['foodData']->foodID,
                    'foodPrice' => $reserve['foodData']->foodPrice,
                    'foodCategoryID' => $reserve['foodData']->foodCategoryID,
                ]);
            }
        });
    }

    public function updateReservationsForMonth(Collection $reservesData, int $userID)
    {
        DB::Transaction(function () use ($reservesData, $userID) {
            foreach($reservesData as $reserve) {
                DB::table('food_reservation')
                    ->where('userID',$userID)
                    ->where('monthID', $reserve['monthID'])
                    ->where('reservDate', $reserve['date'])
                    ->update([
                        'foodID' => $reserve['foodData']->foodID,
                        'foodPrice' => $reserve['foodData']->foodPrice,
                        'foodCategoryID' => $reserve['foodData']->foodCategoryID,
                ]);
            }
        });
    }
}