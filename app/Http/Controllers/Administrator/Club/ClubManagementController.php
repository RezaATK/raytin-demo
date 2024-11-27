<?php

namespace App\Http\Controllers\Administrator\Club;

use App\Http\Controllers\checkNonExistsUserIDs;
use App\Http\Controllers\Controller;
use App\Models\Club\Club;
use App\Models\Club\ClubCategory;
use App\Models\User\User;
use App\Policies\Club\ClubPolicy;
use Illuminate\Support\Facades\Gate;

class ClubManagementController extends Controller
{

    public function index()
    {
        Gate::authorize(ClubPolicy::MANAGE, new Club());

        return view('club.manage');
    }


    public function create()
    {
        Gate::authorize(ClubPolicy::CREATE, new Club());

        $clubCategories = ClubCategory::all();

        return view('club.create', compact('clubCategories'));
    }


    public function store(FoodRequest $request)
    {

        Gate::authorize(ClubPolicy::CREATE, new Club());

        Club::create($request->validated());

        return to_route('club.create')->with('success', 'success');
    }


    public function edit(Club $club)
    {
        Gate::authorize(ClubPolicy::EDIT, new Club());

        $clubCategories = ClubCategory::all();

        return view('club.edit', compact('club', 'clubCategories'));
    }


    public function update(FoodRequest $request, Club $club)
    {
        Gate::authorize(ClubPolicy::EDIT, new Club());

        $club->update($request->validated());

        return to_route('club.edit', ['club' => $club])->with('success', 'success');
    }

}
