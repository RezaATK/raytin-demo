<?php

namespace App\Http\Controllers\Administrator\ClubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Club\ClubCategoryRequest;
use App\Models\Club\ClubCategory;
use App\Policies\ClubCategory\ClubCategoryPolicy;
use Illuminate\Support\Facades\Gate;

class ClubCategoryManagementController extends Controller
{

    public function index()
    {
        Gate::authorize(ClubCategoryPolicy::MANAGE, new ClubCategory());

        return to_route('clubcategory.manage');
    }


    public function manage()
    {
        Gate::authorize(ClubCategoryPolicy::MANAGE, new ClubCategory());

        return view('clubcategory.index');
    }


    public function create()
    {
        Gate::authorize(ClubCategoryPolicy::CREATE, new ClubCategory());

        return view('clubcategory.create');
    }


    public function store(ClubCategoryRequest $request)
    {
        Gate::authorize(ClubCategoryPolicy::CREATE, new ClubCategory());

        ClubCategory::create($request->validated());

        return to_route('clubcategory.create')->with('success','success');
    }


    public function show(ClubCategory $clubCategory)
    {
        //
    }


    public function edit(ClubCategory $clubCategory)
    {
        Gate::authorize(ClubCategoryPolicy::EDIT, $clubCategory);

        return view('clubcategory.edit', compact('clubCategory'));
    }


    public function update(ClubCategoryRequest $request, ClubCategory $clubCategory)
    {
        Gate::authorize(ClubCategoryPolicy::EDIT, $clubCategory);

        $clubCategory->update(['categoryName' => $request->categoryName]);

        return to_route('clubcategory.edit', $clubCategory)->with('success','success');
    }

}
