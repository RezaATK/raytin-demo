<?php

namespace App\Http\Controllers\Administrator\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreRequest;
use App\Models\Store\Store;
use App\Models\Store\StoreCategory;
use App\Models\User\User;
use App\Policies\Store\StorePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class StoreManagementController extends Controller
{

    public function manage()
    {
        $this->authorize(StorePolicy::MANAGE, new Store());

        return view('store.manage');
    }


    public function create()
    {
        $this->authorize(StorePolicy::CREATE, new Store());

        $storeCategories = StoreCategory::all();
        return view('store.create', compact('storeCategories'));
    }


    public function store(StoreRequest $request)
    {
        $this->authorize(StorePolicy::CREATE, new Store());

        $store = Store::create($request->validated());

        if ($file = $request->file('file')) {
            $extension = $file->getClientOriginalExtension();

            $fileName = \Illuminate\Support\Str::random(16) . '.' . $extension;

            $path = '/uploads/stores/' . $store->storeID;

            $fileFullPath = $file->storeAs($path, $fileName);

            if(filled($store->storeImage)){
                Storage::delete($store->storeImage);
            }
            $store->update(['storeImage' => $fileFullPath]);
        }

        return to_route('store.create')->with('success', 'success');
    }




    public function edit(Store $store)
    {
        $this->authorize(StorePolicy::EDIT, new Store());

        $storeCategories = StoreCategory::all();

        return view('store.edit', compact('store', 'storeCategories'));
    }


    public function update(StoreRequest $request, Store $store)
    {
        $this->authorize(StorePolicy::EDIT, new Store());

        $store->update($request->validated());


        if ($file = $request->file('file')) {
            $extension = $file->getClientOriginalExtension();

            $fileName = \Illuminate\Support\Str::random(16) . '.' . $extension;

            $path = '/uploads/stores/' . $store->storeID;

            $fileFullPath = $file->storeAs($path, $fileName);

            if(filled($store->storeImage)){
                Storage::delete($store->storeImage);
            }
            $store->update(['storeImage' => $fileFullPath]);
        }

        return to_route('store.edit', ['store' => $store])->with('success', 'success');
    }

    public function deleteImage(Store $store)
    {
        $this->authorize(StorePolicy::EDIT, new Store());

        Storage::delete($store->storeImage);

        $store->update(['storeImage' => null]);

        return response()->json(['message'  => 'success']);
    }


    public function destroy(Store $store)
    {
        //
    }
}
