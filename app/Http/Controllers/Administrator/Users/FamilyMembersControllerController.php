<?php

namespace App\Http\Controllers\Administrator\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreFamilyRequest;
use App\Models\User\User;
use App\Models\User\UsersFamilymembersIds;
use App\Policies\User\UserFamilyMembersPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FamilyMembersControllerController extends Controller
{

    public function store(StoreFamilyRequest $request, User $user)
    {
        Gate::authorize(UserFamilyMembersPolicy::CREATE, $user->family);

        $validated = $request->validated() + ['employeeID' => $user->employeeID];
        $user->family()->create($validated);
        return redirect('users/edit/' . $user->userID ?? $user->id)
            ->with('success', 'success');
    }

    public function destroy(Request $request, User $user)
    {
        Gate::authorize(UserFamilyMembersPolicy::DELETE, request()->user());

        $family = UsersFamilymembersIds::where('familyID', $request->familyID);

        $family->delete();

        return redirect('users/edit/' . $user->userID ?? $user->id)
            ->with('success', 'success');
    }

}
