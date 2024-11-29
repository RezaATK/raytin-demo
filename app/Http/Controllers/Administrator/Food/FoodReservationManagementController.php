<?php

namespace App\Http\Controllers\Administrator\Food;

use App\Http\Controllers\Controller;
use App\Models\Food\FoodReservation;
use App\Policies\Food\FoodPolicy;
use App\Policies\Food\FoodReservationPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FoodReservationManagementController extends Controller
{
    public function stats()
    {
        $this->authorize(FoodReservationPolicy::STATS, new FoodReservation());

        $todaysDataforCurrentMonthReservData = DB::table('food_reservation')
                        ->selectRaw('food_reservation.foodID, foods.foodName, count(food_reservation.foodID) as foodIDCount')
                        ->leftJoin('foods', 'food_reservation.foodID', '=', 'foods.foodID')
                        ->where('food_reservation.reservDate', Carbon::now()->format('Y-m-d'))
                        ->where('monthID', '=', verta()->month)
                        ->groupBy('food_reservation.foodID')
                        ->get();

        $firstDayOfMonth = jalaliToGregorian(verta()->startMonth()->formatDate());
        $lastDayOfMonth = jalaliToGregorian(verta()->endMonth()->formatDate());      
        $currentMonthReservData = DB::table('food_reservation')
            ->selectRaw('food_reservation.foodID, foods.foodName, count(food_reservation.foodID) as foodIDCount')
            ->JOIN('foods', 'food_reservation.foodID', '=', 'foods.foodID')
            ->whereBetween('food_reservation.reservDate', [$firstDayOfMonth, $lastDayOfMonth])
            ->where('monthID', '=', verta()->month)
            ->groupBy('food_reservation.foodID')
            ->get();


        $firstDayOfYear = jalaliToGregorian(verta()->startYear()->startMonth()->formatDate());
        $lastDayOfYear = jalaliToGregorian(verta()->endMonth()->formatDate());      
        $currentYearReservData = DB::table('food_reservation')
            ->selectRaw('food_reservation.foodID, foods.foodName, count(food_reservation.foodID) as foodIDCount')
            ->JOIN('foods', 'food_reservation.foodID', '=', 'foods.foodID')
            ->whereBetween('food_reservation.reservDate', [$firstDayOfYear, $lastDayOfYear])
            ->where('monthID', '=', verta()->month)
            ->groupBy('food_reservation.foodID')
            ->get();

            $AllMonthsReservations = [];
        try {
            DB::beginTransaction();
            
            
            for ($i = 1; $i < 13; $i++) {
            $firstDayOfMonth = jalaliToGregorian(verta()->month($i)->startMonth()->formatDate());
            $lastDayOfMonth = jalaliToGregorian(verta()->month($i)->endMonth()->formatDate()); 
            $AllMonthsReservations[$i] =  DB::table('food_reservation')
                    ->selectRaw('food_reservation.foodID, foods.foodName, count(food_reservation.foodID) as foodIDCount')
                    ->JOIN('foods', 'food_reservation.foodID', '=', 'foods.foodID')
                    ->whereBetween('food_reservation.reservDate', [$firstDayOfMonth, $lastDayOfMonth])
                    ->where('monthID', '=', verta()->month)
                    ->groupBy('food_reservation.foodID')
                    ->get();
            }            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }    
        
       return view('food.stats', [
           'todaysDataforCurrentMonthReservData' => $todaysDataforCurrentMonthReservData,
           'currentMonthReservData' => $currentMonthReservData,
           'currentYearReservData' => $currentYearReservData,
           'AllMonthsReservations' => $AllMonthsReservations,
       ]);

    }
}
