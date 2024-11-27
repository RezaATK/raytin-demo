<?php

namespace App\Http\Controllers\Administrator\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\FoodAssignmentRequest;
use App\Http\Requests\Food\FoodRequest;
use App\Models\Food\Food;
use App\Models\Food\FoodReservation;
use App\Models\Food\Month;
use Illuminate\Http\Request;

class FoodAssignmentManagementController extends Controller
{
    public function manage()
    {
        return view('food.foodassignment.manage');
    }


    public function edit(Month $month)
    {
        $month->load('foods');

        $foods = Food::whereActive()->get();

        return view('food.foodassignment.edit', compact('month', 'foods'));
    }


    public function update(FoodAssignmentRequest $request, Month $month)
    {
        // todos: check if there are active records for this month.
        if(! FoodReservation::query()->isMonthAllowedToBeEdited($month->monthID)) {
            return to_route('foodassignment.edit', $month)
                ->with('failed', 'برای غذای انتخابی در ماه جاری/آینده رزرو فعال وجود دارد، امکان تغییر آن تا اتمام آن وجود ندارد.');
        }

        $month->foods()->sync($request->foods);

        return to_route('foodassignment.edit', $month)->with('success', 'success');
    }
}
