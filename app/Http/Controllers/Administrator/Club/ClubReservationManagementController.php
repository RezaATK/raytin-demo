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
            ->where('verification', '=', 'verified')
            ->groupBy('clubs.clubID')
            ->orderBy('MostReserved', 'desc')
            ->limit(10)->get();

        return view('club.stats', [
            'popularClubs' => $popularClubs,
        ]);
    }
}
