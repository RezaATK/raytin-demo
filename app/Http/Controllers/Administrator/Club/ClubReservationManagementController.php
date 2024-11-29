<?php

namespace App\Http\Controllers\Administrator\Club;

use App\Http\Controllers\Controller;
use App\Models\Club\Club;
use App\Models\Club\ClubReservations;
use App\Policies\Club\ClubReservationPolicy;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClubReservationManagementController extends Controller
{
    public function index()
    {
        Gate::authorize(ClubReservationPolicy::MANAGE, new ClubReservations());

        return view('club.allreservations');
    }




    public function stats()
    {

        Gate::authorize(ClubReservationPolicy::STATS, new ClubReservations());

        $popularClubs = ClubReservations::query()
                        ->selectRaw('count(club_reservation.clubID) as MostReserved, clubs.clubName, club_reservation.clubID')
                        ->join('clubs', 'clubs.clubID', '=', 'club_reservation.clubID')
                        ->where('club_reservation.verification', '=', 'verified')
                        ->groupBy('clubs.clubID')
                        ->orderBy('MostReserved', 'desc')
                        ->limit(10)
                        ->get();

        $lastMonthDate = jalaliToGregorian(verta()->subMonth()->startMonth()->formatDate());
        $lastMonthReserveData =  ClubReservations::query()
                                        ->selectRaw('count(club_reservation.clubID) as count')
                                        ->where('reservDate', '=', $lastMonthDate)
                                        ->where('verification', '=', 'verified')
                                        ->get();   
        
        $currentMonthDate = jalaliToGregorian(verta()->startMonth()->formatDate());
        $currentMonthReserveData =  ClubReservations::query()
                                        ->selectRaw('count(club_reservation.clubID) as count')
                                        ->where('reservDate', '=', $currentMonthDate)
                                        ->where('verification', '=', 'verified')
                                        ->get();   
        
        $nextMonthDate = jalaliToGregorian(verta()->startMonth()->addMonth()->formatDate());
        $nextMonthReserveData =  ClubReservations::query()
                                        ->selectRaw('count(club_reservation.clubID) as count')
                                        ->where('reservDate', '=', $nextMonthDate)
                                        ->where('verification', '=', 'verified')
                                        ->get();   
        $startOfYear = jalaliToGregorian(verta()->startYear()->startMonth()->formatDate());
        $endOfYear = jalaliToGregorian(verta()->startMonth()->formatDate());
        $allCurrentYearReservations =  ClubReservations::query()
                                        ->selectRaw('count(club_reservation.clubID) as count')
                                        ->whereBetween('reservDate', [$startOfYear, $endOfYear])
                                        ->where('verification', '=', 'verified')
                                        ->get();   
        return view('club.stats', [
            'popularClubs' => $popularClubs,
            'lastMonthReserveData' => $lastMonthReserveData[0]-> count ?? 0,
            'currentMonthReserveData' => $currentMonthReserveData[0]-> count ?? 0,
            'nextMonthReserveData' => $nextMonthReserveData[0]-> count ?? 0,
            'allCurrentYearReservations' => $allCurrentYearReservations[0]-> count ?? 0,
        ]);
    }
}
