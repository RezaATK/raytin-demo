<?php

namespace App\Policies\User;

use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    const UserManage = 'user:manage';

    const UserCreate = 'user:create';

    const UserEdit = 'user:edit';

    const UserDelete = 'user:delete';


    const MANAGE = 'manage';

    const CREATE = 'create';

    const EDIT = 'edit';

    const DELETE = 'delete';



    public function manage(User $user): Response
    {
        return $user->can(self::UserManage) ? Response::allow() : Response::deny();
    }


    public function create(User $user): Response
    {
        return $user->can(self::UserCreate) ? Response::allow() : Response::deny();
    }


    public function edit(User $user): Response
    {
        return $user->can(self::UserEdit) ? Response::allow() : Response::deny();
    }


    public function delete(User $user): Response
    {
        return $user->can(self::UserDelete) ? Response::allow() : Response::deny();
    }
}
