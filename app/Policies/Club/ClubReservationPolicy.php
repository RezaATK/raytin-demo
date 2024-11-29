<?php

namespace App\Policies\Club;

use App\Models\Club\ClubReservations;
use App\Models\User\User;
use Illuminate\Auth\Access\Response;

class ClubReservationPolicy
{

    private const ClubReservationReserve = 'clubreserve:reserve';

    private const ClubReservationMyReservations = 'clubreserve:myreservations';

    private const ClubReservationOwnLetter = 'clubreserve:ownletter';

    private const ClubReservationAllLetters = 'clubreservation:allletters';

    private const ClubReservationManage = 'clubreservation:manage';

    private const ClubReservationApprove = 'clubreservation:approve';

    private const ClubReservationReject = 'clubreservation:reject';

    private const ClubReservationSTATS = 'clubreservation:stats';

    private const ClubReservationExport = 'clubreservation:export';
    
    private const ClubReservationDelete = 'clubreservation:delete';

    const RESERVE = 'reserve';

    const MYRESERVATIONS = 'myreservations';
    
    const LETTER = 'letter';

    const MANAGE = 'manage';

    const APPROVE = 'approve';

    const REJECT = 'reject';

    const STATS = 'stats';

    const EXPORT = 'export';
    
    const DELETE = 'delete';
    
    // const ALLLETTER = 'delete';
    public function reserve(User $user): bool
    {
        return $user->can(self::ClubReservationReserve);
    }


    public function myreservations(User $user): bool
    {
        return $user->can(self::ClubReservationMyReservations);
    }


    public function letter(User $user, ClubReservations $clubReservations)
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


    public function export(User $user, ClubReservations $clubReservations): bool
    {
        return $user->can(self::ClubReservationExport);
    }


    public function delete(User $user, ClubReservations $clubReservations): bool
    {
        return $user->can(self::ClubReservationDelete);
    }


}
