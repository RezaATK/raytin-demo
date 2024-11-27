<?php

namespace App\Policies\Store;

use App\Models\Store\StoreDiscount;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class StoreDiscountPolicy
{

    private const StoreDiscountsRequest = 'storediscounts:request';
    private const StoreDiscountsMyDiscounts = 'storediscounts:mydiscounts';
    private const StoreDiscountsOwnLetter = 'storediscounts:ownletter';
    private const StoreDiscountsSTATS = 'storediscountsstats:stats';


    private const AllDiscountsManageAbility = 'alldiscounts:manage';
    private const AllDiscountsApproveAbility = 'alldiscounts:approve';
    private const AllDiscountsRejectAbility = 'alldiscounts:reject';
    private const AllDiscountsDeleteAbility = 'alldiscounts:delete';

    private const VerifyDiscountsAllLettersAbility = 'verifydiscounts:allletters';
    private const VerifyDiscountsManageAbility = 'verifydiscounts:manage';
    private const VerifyDiscountsRejectAbility = 'verifydiscounts:reject';
    private const VerifyDiscountsApproveAbility = 'verifydiscounts:approve';
    private const VerifyDiscountsDeleteAbility = 'verifydiscounts:delete';
    private const VerifyDiscountsAdditionalNoteAbility = 'verifydiscounts:additionalnote';


    const REQUEST = 'request';
    const MYDISCOUNTS = 'mydiscounts';
    const STATS = 'stats';
    const LETTER = 'letter';

    const AllDiscountsManage = 'allDiscountsManage';
    const AllDiscountsApprove = 'allDiscountsApprove';
    const AllDiscountsReject = 'allDiscountsReject';
    const AllDiscountsDelete = 'allDiscountsDelete';

    const VerifyDiscountsManage = 'verifyDiscountsManage';
    const VerifyDiscountsApprove = 'verifyDiscountsApprove';
    const VerifyDiscountsReject = 'verifyDiscountsReject';
    const VerifyDiscountsDelete = 'verifyDiscountsDelete';
    const VerifyDiscountsAdditionalNote = 'verifyDiscountsAdditionalNote';


    public function request(User $user): bool
    {
        return $user->can(self::StoreDiscountsRequest);
    }


    public function mydiscounts(User $user): bool
    {
        return $user->can(self::StoreDiscountsMyDiscounts);
    }


    public function letter(User $user, StoreDiscount $storeDiscount): Response|bool
    {
        if($storeDiscount->verification_two !== 'verified'){
            return Response::denyAsNotFound();
        }

        if($user->can(self::VerifyDiscountsAllLettersAbility)){
            return Response::allow();
        }

        if($storeDiscount->userID !== auth()->user()->userID){
            return Response::denyAsNotFound();
        }

        return $user->can(self::StoreDiscountsOwnLetter);
    }

    public function stats(User $user): bool
    {
        return $user->can(self::StoreDiscountsSTATS);
    }



    public function allDiscountsManage(User $user): bool
    {
        return $user->can(self::AllDiscountsManageAbility);
    }

    public function allDiscountsApprove(User $user): bool
    {
        return $user->can(self::AllDiscountsApproveAbility);
    }

    public function allDiscountsReject(User $user): bool
    {
        return $user->can(self::AllDiscountsRejectAbility);
    }


    public function allDiscountsDelete(User $user): bool
    {
        return $user->can(self::AllDiscountsDeleteAbility);
    }



    public function verifyDiscountsManage(User $user): bool
    {
        return $user->can(self::VerifyDiscountsManageAbility);
    }

    public function verifyDiscountsApprove(User $user): bool
    {
        return $user->can(self::VerifyDiscountsApproveAbility);
    }

    public function verifyDiscountsReject(User $user): bool
    {
        return $user->can(self::VerifyDiscountsRejectAbility);
    }


    public function verifyDiscountsDelete(User $user): bool
    {
        return $user->can(self::VerifyDiscountsDeleteAbility);
    }

    public function verifyDiscountsAdditionalNote(User $user): bool
    {
        return $user->can(self::VerifyDiscountsAdditionalNoteAbility);
    }
}
