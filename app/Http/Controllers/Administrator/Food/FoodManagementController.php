<?php

namespace App\Http\Controllers\Administrator\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\FoodRequest;
use App\Models\Food\Food;
use App\Models\Food\FoodCategory;
use App\Models\Food\Month;
use App\Policies\Food\FoodPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FoodManagementController extends Controller
{

    public function manage()
    {
        Gate::authorize(FoodPolicy::MANAGE, new Food());

        return view('food.manage');
    }


    public function create()
    {
        Gate::authorize(FoodPolicy::CREATE, new Food());

        $categories = FoodCategory::all();

        return view('food.create', compact('categories'));
    }


    public function store(FoodRequest $request)
    {
        Gate::authorize(FoodPolicy::CREATE, new Food());

        Food::create($request->validated());

        return to_route('food.create')->with('success', 'success');

    }


    public function edit(Food $food)
    {
        Gate::authorize(FoodPolicy::EDIT, new Food());

        $categories = FoodCategory::all();

        return view('food.edit', compact('food', 'categories'));
    }


    public function update(FoodRequest $request, Food $food)
    {
        Gate::authorize(FoodPolicy::EDIT, new Food());

        $food->update($request->validated());

        return to_route('food.edit', $food)->with('success', 'success');
    }


    public function destroy($id)
    {

    }
}
