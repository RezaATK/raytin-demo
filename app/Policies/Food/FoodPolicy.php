<?php

namespace App\Policies\Food;

use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class FoodPolicy
{
    private const FoodManage = 'food:manage';
    private const FoodCreate = 'food:create';
    private const FoodEdit = 'food:edit';
    private const FoodDelete = 'food:delete';
    private const FoodToggleStatus = 'food:togglestatus';
    private const FoodAssignmentManageAbility = 'foodassignment:manage';
    private const FoodAssignmentEditAbility = 'foodassignment:edit';

    const MANAGE = 'manage';
    const CREATE = 'create';
    const EDIT = 'edit';
    const DELETE = 'delete';
    const TOGGLE = 'toggle';
    const foodAssignmentManage = 'foodAssignmentManage';
    const foodAssignmentEdit = 'foodAssignmentEdit';

    public function manage(User $user): Response
    {
        return $user->can(self::FoodManage) ? Response::allow() : Response::deny();
    }

    public function create(User $user): Response
    {
        return $user->can(self::FoodCreate) ? Response::allow() : Response::deny();
    }

    public function edit(User $user): Response
    {
        return $user->can(self::FoodEdit) ? Response::allow() : Response::deny();
    }

    public function delete(User $user): Response
    {
        return $user->can(self::FoodDelete) ? Response::allow() : Response::deny();
    }

    public function toggle(User $user): Response
    {
        return $user->can(self::FoodToggleStatus) ? Response::allow() : Response::deny();
    }

    public function foodAssignmentManage(User $user): Response
    {
        return $user->can(self::FoodAssignmentManageAbility) ? Response::allow() : Response::deny();
    }

    public function foodAssignmentEdit(User $user): Response
    {
        return $user->can(self::FoodAssignmentEditAbility) ? Response::allow() : Response::deny();
    }

}