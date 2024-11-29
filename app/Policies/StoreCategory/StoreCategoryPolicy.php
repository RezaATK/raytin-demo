<?php

namespace App\Policies\StoreCategory;

use App\Models\Store\StoreCategory;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class StoreCategoryPolicy
{
    const StoreCategoryManage = 'storecategory:manage';

    const StoreCategoryCreate = 'storecategory:create';

    const StoreCategoryEdit = 'storecategory:edit';

    const StoreCategoryDelete = 'storecategory:delete';
    
    const StoreCategoryExport = 'storecategory:export';


    const MANAGE = 'manage';

    const CREATE = 'create';

    const EDIT = 'edit';

    const EXPORT = 'export';
    
    const DELETE = 'delete';


    public function manage(User $user, StoreCategory $storeCategory): Response
    {
        return $user->can(self::StoreCategoryManage) ? Response::allow() : Response::deny();
    }


    public function create(User $user): Response
    {
        return $user->can(self::StoreCategoryCreate) ? Response::allow() : Response::deny();
    }


    public function edit(User $user, StoreCategory $storeCategory): Response
    {
        return $user->can(self::StoreCategoryEdit) ? Response::allow() : Response::deny();
    }


    public function export(User $user, StoreCategory $storeCategory): Response
    {
        return $user->can(self::StoreCategoryExport) ? Response::allow() : Response::deny();
    }
    

    public function delete(User $user, StoreCategory $storeCategory): Response
    {
        return $user->can(self::StoreCategoryDelete) ? Response::allow() : Response::deny();
    }
}
