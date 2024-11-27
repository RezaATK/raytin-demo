<?php

namespace App\Http\Controllers\Administrator\StoreCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreCategoryRequest;
use App\Models\Store\StoreCategory;
use App\Policies\StoreCategory\StoreCategoryPolicy;
use Illuminate\Support\Facades\Gate;

class StoreCategoryManagementController extends Controller
{

    public function index()
    {
        Gate::authorize(StoreCategoryPolicy::MANAGE, new StoreCategory());

        return to_route('storecategory.manage');
    }


    public function manage()
    {
        Gate::authorize(StoreCategoryPolicy::MANAGE, new StoreCategory());

        return view('storecategory.index');
    }


    public function create()
    {
        Gate::authorize(StoreCategoryPolicy::CREATE, new StoreCategory());

        return view('storecategory.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize(StoreCategoryPolicy::CREATE, new StoreCategory());

        StoreCategory::create($request->validated());

        return to_route('storecategory.create')->with('success','success');
    }


    public function show(StoreCategory $storeCategory)
    {
        //
    }


    public function edit(StoreCategory $storeCategory)
    {
        Gate::authorize(StoreCategoryPolicy::EDIT, $storeCategory);

        return view('storecategory.edit', compact('storeCategory'));
    }


    public function update(StoreCategoryRequest $request, StoreCategory $storeCategory)
    {
        Gate::authorize(StoreCategoryPolicy::EDIT, $storeCategory);

        $storeCategory->update(['categoryName' => $request->categoryName]);

        return to_route('storecategory.edit', $storeCategory)->with('success','success');
    }


    public function destroy(StoreCategory $storeCategory)
    {
        //
    }
}