<?php

namespace App\Http\Controllers\Administrator\Food;

use App\Http\Controllers\Controller;
use App\Models\Food\FoodReservation;
use App\Policies\Food\FoodReservationPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FoodReservationManagementController extends Controller
{
    public function stats()
    {

        Gate::authorize(FoodReservationPolicy::STATS, new FoodReservation());
//
//        DB::enableQueryLog();
//        $popularStores = StoreReservations::query()
//            ->selectRaw('count(store_reservation.storeID) as MostReserved, stores.storeName, store_reservation.storeID')
//            ->join('stores', 'stores.storeID', '=', 'store_reservation.storeID')
//            ->where('verification', '=', 'verified')
//            ->groupBy('stores.storeID')
//            ->orderBy('MostReserved', 'desc')
//            ->limit(10)->get();
//
//
////        dd(DB::getQueryLog($popularStores));
//
//        return view('store.stats', [
//            'popularStores' => $popularStores,
//        ]);
        return [];
    }
}
