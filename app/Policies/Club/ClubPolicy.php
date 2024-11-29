<?php

namespace App\Policies\Club;

use App\Models\Club\Club;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class ClubPolicy
{

    private const ClubManage = 'club:manage';

    private const ClubCreate = 'club:create';

    private const ClubEdit = 'club:edit';

    private const ClubExport = 'club:export';
    
    private const ClubDelete = 'club:delete';

    const MANAGE = 'manage';

    const CREATE = 'create';

    const EDIT = 'edit';

    const EXPORT = 'export';
    
    const DELETE = 'delete';


    public function manage(User $user, Club $club): Response
    {
        return $user->can(self::ClubManage) ? Response::allow() : Response::deny();
    }


    public function create(User $user): Response
    {
        return $user->can(self::ClubCreate) ? Response::allow() : Response::deny();
    }


    public function edit(User $user, Club $club): Response
    {
        return $user->can(self::ClubEdit) ? Response::allow() : Response::deny();
    }


    public function export(User $user, Club $club): Response
    {
        return $user->can(self::ClubExport) ? Response::allow() : Response::deny();
    }

    public function delete(User $user, Club $club): Response
    {
        return $user->can(self::ClubDelete) ? Response::allow() : Response::deny();
    }
}
