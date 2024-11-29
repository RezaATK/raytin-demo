<?php

namespace App\Http\Controllers\Administrator\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\FoodAssignmentRequest;
use App\Http\Requests\Food\FoodRequest;
use App\Models\Food\Food;
use App\Models\Food\FoodReservation;
use App\Models\Food\Month;
use App\Policies\Food\FoodPolicy;

class FoodAssignmentManagementController extends Controller
{
    public function manage()
    {
        $this->authorize(FoodPolicy::foodAssignmentManage, new Food());

        return view('food.foodassignment.manage');
    }


    public function edit(Month $month)
    {
        $this->authorize(FoodPolicy::foodAssignmentEdit, new Food());

        $month->load('foods');

        $foods = Food::whereActive()->get();

        return view('food.foodassignment.edit', compact('month', 'foods'));
    }


    public function update(FoodAssignmentRequest $request, Month $month)
    {
        $this->authorize(FoodPolicy::foodAssignmentEdit, new Food());

        $currentMonthFirstDay = jalaliToGregorian(verta()->month($month->monthID)->startMonth()->formatDate());
        $nextMonthLastDay = jalaliToGregorian(verta()->month($month->monthID)->addMonth()->endMonth()->formatDate());
        // dump($month->monthID);
        $month->load('foods');
        $currentActiveFoodIDs = $month->foods()->get()->pluck('foodID')->toArray();
        $foodsThatHaveActiveReserve = FoodReservation::query()
            ->selectRaw('max(foodID) as UF')
            ->whereIn('foodID', $currentActiveFoodIDs)
            ->whereBetween('reservDate', [$currentMonthFirstDay, $nextMonthLastDay])
            ->groupBy('foodID')
            ->get()->pluck('UF')->toArray();
            // dump($a);
        // dd('');
        // foreach ($foodsThatHaveActiveReserve as $key => $reserve) {
            // (FoodReservation::query()->where('foodID', $currentActiveFoodIDs[$key])->whereBetween('reservDate', '=')->first())?->foodID;
        // }

        if(!empty(array_diff($foodsThatHaveActiveReserve, array_map('intval',$request->foods)))){
            return to_route('foodassignment.edit', $month)
            ->with('failed', 'برای غذای انتخابی در ماه جاری/آینده رزرو فعال وجود دارد، امکان تغییر آن تا اتمام آن وجود ندارد.');
        }

        $month->foods()->sync($request->foods);

        return to_route('foodassignment.edit', $month)->with('success', 'success');
    }
}
