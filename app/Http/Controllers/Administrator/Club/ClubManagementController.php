<?php

namespace App\Http\Controllers\Administrator\Club;

use App\Http\Controllers\checkNonExistsUserIDs;
use App\Http\Controllers\Controller;
use App\Http\Requests\Club\ClubRequest;
use App\Models\Club\Club;
use App\Models\Club\ClubCategory;
use App\Models\User\User;
use App\Policies\Club\ClubPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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


    public function store(ClubRequest $request)
    {

        Gate::authorize(ClubPolicy::CREATE, new Club());

        $club = Club::create($request->validated());

        if ($file = $request->file('file')) {
            $extension = $file->getClientOriginalExtension();

            $fileName = \Illuminate\Support\Str::random(16) . '.' . $extension;

            $path = '/uploads/stores/' . $club->clubID;

            $fileFullPath = $file->storeAs($path, $fileName);

            if(filled($club->clubImage)){
                Storage::delete($club->clubImage);
            }
            $club->update(['clubImage' => $fileFullPath]);
        }

        return to_route('club.create')->with('success', 'success');
    }


    public function edit(Club $club)
    {
        Gate::authorize(ClubPolicy::EDIT, new Club());

        $clubCategories = ClubCategory::all();

        return view('club.edit', compact('club', 'clubCategories'));
    }


    public function update(ClubRequest $request, Club $club)
    {
        Gate::authorize(ClubPolicy::EDIT, new Club());

        $club->update($request->validated());

        if ($file = $request->file('file')) {
            $extension = $file->getClientOriginalExtension();

            $fileName = \Illuminate\Support\Str::random(16) . '.' . $extension;

            $path = '/uploads/stores/' . $club->clubID;

            $fileFullPath = $file->storeAs($path, $fileName);

            if(filled($club->clubImage)){
                Storage::delete($club->clubImage);
            }
            $club->update(['clubImage' => $fileFullPath]);
        }

        return to_route('club.edit', ['club' => $club])->with('success', 'success');
    }

    public function deleteImage(Club $club)
    {
        Gate::authorize(ClubPolicy::EDIT, new Club());

        Storage::delete($club->clubImage);

        $club->update(['clubImage' => null]);

        return response()->json(['message'  => 'success']);
    }

}
