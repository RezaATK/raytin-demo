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
        $this->authorize(ClubCategoryPolicy::MANAGE, new ClubCategory());

        return to_route('clubcategory.manage');
    }


    public function manage()
    {
        $this->authorize(ClubCategoryPolicy::MANAGE, new ClubCategory());

        return view('clubcategory.index');
    }


    public function create()
    {
        $this->authorize(ClubCategoryPolicy::CREATE, new ClubCategory());

        return view('clubcategory.create');
    }


    public function store(ClubCategoryRequest $request)
    {
        $this->authorize(ClubCategoryPolicy::CREATE, new ClubCategory());

        ClubCategory::create($request->validated());

        return to_route('clubcategory.create')->with('success','success');
    }


    public function show(ClubCategory $clubCategory)
    {
        //
    }


    public function edit(ClubCategory $clubCategory)
    {
        $this->authorize(ClubCategoryPolicy::EDIT, new ClubCategory());

        return view('clubcategory.edit', compact('clubCategory'));
    }


    public function update(ClubCategoryRequest $request, ClubCategory $clubCategory)
    {
        $this->authorize(ClubCategoryPolicy::EDIT, new ClubCategory());

        $clubCategory->update(['categoryName' => $request->categoryName]);

        return to_route('clubcategory.edit', $clubCategory)->with('success','success');
    }

}
