<?php

namespace App\Policies\User;

use App\Models\User\User;
use App\Models\User\UsersFamilymembersIds;
use Illuminate\Auth\Access\Response;

class UserFamilyMembersPolicy
{
    const FamilyMemberCreate = 'usersfamilymembers:create';

    const FamilyMemberEdit = 'usersfamilymembers:edit';

    const FamilyMemberDelete = 'usersfamilymembers:delete';


    const CREATE = 'create';

    const EDIT = 'edit';

    const DELETE = 'delete';


    public function create(User $user): Response
    {
        return $user->can(self::FamilyMemberCreate) ? Response::allow() : Response::deny();
    }


    public function edit(User $user): Response
    {
        return $user->can(self::FamilyMemberEdit) ? Response::allow() : Response::deny();
    }


    public function delete(User $user): Response
    {
        return $user->can(self::FamilyMemberDelete) ? Response::allow() : Response::deny();
    }
}
