<?php

namespace App\Http\Controllers\Administrator\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUsersRequest;
use App\Models\User\EmploymentType;
use App\Models\User\Unit;
use App\Models\User\User;
use App\Policies\User\UserFamilyMembersPolicy;
use App\Policies\User\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index()
    {
        return to_route('dashboard');
    }


    public function manage()
    {
        Gate::authorize(UserPolicy::MANAGE, new User());

        return view('users.index');
    }


    public function create()
    {
        Gate::authorize(UserPolicy::CREATE, new User());

        $genderTypes = [0 => 'male',1 => 'female'];
        $employmentTypes = EmploymentType::all();
        $units = Unit::all();

        return view('users.create', compact('genderTypes', 'employmentTypes', 'units'));
    }


    public function store(StoreUsersRequest $request)
    {
        Gate::authorize(UserPolicy::CREATE, new User());

        $validated = $request->validated();

        if($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        }

        User::query()->create($validated);

        return to_route('users.create')->with('success', 'success');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        Gate::authorize(UserPolicy::EDIT, $user);

        $genderTypes = [0 => 'male',1 => 'female'];
        $employmentTypes = EmploymentType::all();
        $units = Unit::all();
        $user->load('family');
        $relationshipList = [
            0 => 'همسر',
            1 => 'فرزند',
            2 => 'پدر',
            3 => 'مادر',
            4 => 'خواهر',
            5 => 'برادر',
        ];

        $roles = Role::all();
        return view('users.edit', compact('genderTypes', 'employmentTypes', 'units', 'user', 'relationshipList', 'roles'));
    }


    public function update(StoreUsersRequest $request, User $user)
    {
        Gate::authorize(UserPolicy::EDIT, $user);

//        $validated = $request->validated();

        if($request->password){
            $user->update($request->except('role'));
        }else{
            $user->update($request->except(['role','password']));
        }

        $user->syncRoles($request->role);

        return to_route('users.edit', $user)->with('success', 'success');
    }


    public function destroy(User $user)
    {
        //
    }
}