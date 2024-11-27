<?php

namespace App\Policies\Club;

use App\Models\Club\ClubReservations;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class ClubReservationPolicy
{

    const ClubReservationReserve = 'clubreserve:reserve';

    const ClubReservationMyReservations = 'clubreserve:myreservations';

    const ClubReservationOwnLetter = 'clubreserve:ownletter';

    const ClubReservationAllLetters = 'clubreservation:allletter';

    const ClubReservationManage = 'clubreservation:manage';

    const ClubReservationApprove = 'clubreservation:approve';

    const ClubReservationReject = 'clubreservation:reject';

    const ClubReservationSTATS = 'clubreservation:stats';

    const ClubReservationDelete = 'clubreservation:delete';


    const RESERVE = 'reserve';

    const MYRESERVATIONS = 'myreservations';

    const MANAGE = 'manage';

    const APPROVE = 'approve';

    const REJECT = 'reject';

    const STATS = 'stats';

    const DELETE = 'delete';


    public function reserve(User $user): bool
    {
        return $user->can(self::ClubReservationReserve);
    }


    public function myreservations(User $user): bool
    {
        return $user->can(self::ClubReservationMyReservations);
    }


    public function letter(User $user, ClubReservations $clubReservations): Response|bool
    {
        if($clubReservations->verification !== 'verified'){
            return Response::denyAsNotFound();
        }

        if($user->can(self::ClubReservationAllLetters)){
            return Response::allow();

        }
        if($clubReservations->userID !== auth()->user()->userID){
            return Response::denyAsNotFound();
        }
        return $user->can(self::ClubReservationOwnLetter);
    }


    public function manage(User $user): bool
    {
        return $user->can(self::ClubReservationManage);
    }


    public function approve(User $user): bool
    {
        return $user->can(self::ClubReservationApprove);
    }


    public function reject(User $user, ClubReservations $clubReservations): bool
    {
        return $user->can(self::ClubReservationReject);
    }

    public function stats(User $user, ClubReservations $clubReservations): bool
    {
        return $user->can(self::ClubReservationSTATS);
    }


    public function delete(User $user, ClubReservations $clubReservations): bool
    {
        return $user->can(self::ClubReservationDelete);
    }


}
