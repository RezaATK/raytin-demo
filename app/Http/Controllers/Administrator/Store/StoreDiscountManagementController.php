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
        $this->authorize(StoreDiscountPolicy::AllDiscountsManage, new StoreDiscount());

        return view('store.alldiscounts');
    }


    public function verifydiscounts()
    {
        $this->authorize(StoreDiscountPolicy::VerifyDiscountsManage, new StoreDiscount());

        return view('store.verifydiscounts');
    }


    public function stats()
    {

        Gate::authorize(StoreDiscountPolicy::STATS, new StoreDiscount());

       $popularStores = StoreDiscount::query()
           ->selectRaw('count(store_discounts.storeID) as MostReserved, stores.storeName, store_discounts.storeID')
           ->join('stores', 'stores.storeID', '=', 'store_discounts.storeID')
           ->where('store_discounts.verification_two', '=', 'verified')
           ->groupBy('stores.storeID')
           ->orderBy('MostReserved', 'desc')
           ->limit(10)
           ->get();

           
        $lastMonthDate = jalaliToGregorian(verta()->subMonth()->startMonth()->formatDate());
        $lastMonthReserveData =  StoreDiscount::query()
                                        ->selectRaw('count(store_discounts.storeID) as count')
                                        ->where('discountDate', '=', $lastMonthDate)
                                        ->where('verification_two', '=', 'verified')
                                        ->get();   
        
        $currentMonthDate = jalaliToGregorian(verta()->startMonth()->formatDate());
        $currentMonthReserveData =  StoreDiscount::query()
                                        ->selectRaw('count(store_discounts.storeID) as count')
                                        ->where('discountDate', '=', $currentMonthDate)
                                        ->where('verification_two', '=', 'verified')
                                        ->get();   
           
        $startOfYear = jalaliToGregorian(verta()->startYear()->startMonth()->formatDate());
        $endOfYear = jalaliToGregorian(verta()->startMonth()->formatDate());
        $allCurrentYearReservations =  StoreDiscount::query()
                                        ->selectRaw('count(store_discounts.storeID) as count')
                                        ->whereBetween('discountDate', [$startOfYear, $endOfYear])
                                        ->where('verification_two', '=', 'verified')
                                        ->get();   


       return view('store.stats', [
            'popularStores' => $popularStores,
            'lastMonthReserveData' => $lastMonthReserveData[0]-> count ?? 0,
            'currentMonthReserveData' => $currentMonthReserveData[0]-> count ?? 0,
            'allCurrentYearReservations' => $allCurrentYearReservations[0]-> count ?? 0,
        ]);
    }
}
