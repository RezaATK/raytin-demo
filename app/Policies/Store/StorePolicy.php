<?php

namespace App\Policies\Store;

use App\Models\Store\Store;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class StorePolicy
{
    const StoreManage = 'store:manage';

    const StoreCreate = 'store:create';

    const StoreEdit = 'store:edit';

    const StoreDelete = 'store:delete';


    const MANAGE = 'manage';

    const CREATE = 'create';

    const EDIT = 'edit';

    const DELETE = 'delete';



    public function manage(User $user, Store $store): Response
    {
        return $user->can(self::StoreManage) ? Response::allow() : Response::deny();
    }


    public function create(User $user): Response
    {
        return $user->can(self::StoreCreate) ? Response::allow() : Response::deny();
    }


    public function edit(User $user, Store $store): Response
    {
        return $user->can(self::StoreEdit) ? Response::allow() : Response::deny();
    }


    public function delete(User $user, Store $store): Response
    {
        return $user->can(self::StoreDelete) ? Response::allow() : Response::deny();
    }
}
