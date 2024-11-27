<?php

namespace App\Http\Controllers\Administrator\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\StoreDiscount;
use App\Policies\Store\StoreDiscountPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StoreDiscountManagementController extends Controller
{


    public function alldiscounts()
    {
        Gate::authorize(StoreDiscountPolicy::AllDiscountsManage, new StoreDiscount());

        return view('store.alldiscounts');
    }


    public function verifydiscounts()
    {
        Gate::authorize(StoreDiscountPolicy::VerifyDiscountsManage, new StoreDiscount());

        return view('store.verifydiscounts');
    }


    public function stats()
    {

        Gate::authorize(StoreDiscountPolicy::STATS, new StoreDiscount());
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
