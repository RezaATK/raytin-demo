<?php

namespace App\Policies\User;

use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    private const UserManage = 'user:manage';

    private const UserCreate = 'user:create';

    private const UserEdit = 'user:edit';

    private const UserExport = 'user:export';
    
    private const UserDelete = 'user:delete';

    
    const MANAGE = 'manage';

    const CREATE = 'create';

    const EDIT = 'edit';

    const EXPORT = 'export';
    
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


    public function export(User $user): Response
    {
        return $user->can(self::UserExport) ? Response::allow() : Response::deny();
    }

    public function delete(User $user): Response
    {
        return $user->can(self::UserDelete) ? Response::allow() : Response::deny();
    }
}
