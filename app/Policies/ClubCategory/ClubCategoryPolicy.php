<?php

namespace App\Policies\ClubCategory;

use App\Models\Club\ClubCategory;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class ClubCategoryPolicy
{
    const ClubCategoryManage = 'clubcategory:manage';

    const ClubCategoryCreate = 'clubcategory:create';

    const ClubCategoryEdit = 'clubcategory:edit';

    const ClubCategoryExport = 'clubcategory:export';
    
    const ClubCategoryDelete = 'clubcategory:delete';


    const MANAGE = 'manage';

    const CREATE = 'create';

    const EDIT = 'edit';

    const DELETE = 'delete';
    
    const EXPORT = 'export';


    public function manage(User $user, ClubCategory $clubCategory): Response
    {
        return $user->can(self::ClubCategoryManage) ? Response::allow() : Response::deny();
    }


    public function create(User $user): Response
    {
        return $user->can(self::ClubCategoryCreate) ? Response::allow() : Response::deny();
    }


    public function edit(User $user, ClubCategory $clubCategory): Response
    {
        return $user->can(self::ClubCategoryEdit) ? Response::allow() : Response::deny();
    }


    public function export(User $user, ClubCategory $clubCategory): Response
    {
        return $user->can(self::ClubCategoryExport) ? Response::allow() : Response::deny();
    }

    public function delete(User $user, ClubCategory $clubCategory): Response
    {
        return $user->can(self::ClubCategoryDelete) ? Response::allow() : Response::deny();
    }


}
