<?php

namespace App\Http\Controllers;

use App\Models\Club\ClubReservations;
use App\Models\Food\FoodReservation;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $popularClubs = ClubReservations::query()
        ->selectRaw('count(club_reservation.clubID) as MostReserved, clubs.clubName, club_reservation.clubID')
        ->join('clubs', 'clubs.clubID', '=', 'club_reservation.clubID')
        ->where('club_reservation.verification', '=', 'verified')
        ->groupBy('clubs.clubID')
        ->orderBy('MostReserved', 'desc')
        ->limit(5)
        ->get();

        $usersCount = User::query()
        ->selectRaw('count(*) as UsersCount')
        ->first();
        
        $todaysFood = DB::table('food_reservation')
        ->where('food_reservation.reservDate', (new Carbon())->now()->format('Y-m-d'))
        ->where('food_reservation.userID', request()->user()->userID)
        ->join('foods', 'foods.foodID', '=', 'food_reservation.foodID')
        ->select('foodName')
        ->first();




        return view('dashboard', [
            'popularClubs' => $popularClubs,
            'usersCount' => $usersCount,
            'todaysFood' => $todaysFood,
        ]);
    }
}