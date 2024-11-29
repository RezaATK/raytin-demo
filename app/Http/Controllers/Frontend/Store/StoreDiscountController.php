<?php

namespace App\Http\Controllers\Frontend\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\Store;
use App\Models\Store\StoreCategory;
use App\Models\Store\StoreDiscount;
use App\Models\User\User;
use App\Policies\Store\StoreDiscountPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class StoreDiscountController extends Controller
{
    public function index()
    {
        $this->authorize(StoreDiscountPolicy::REQUEST, new StoreDiscount());

        $allActiveStores = Store::with('category')->where('isActive', '=', 1)->get();
        $allCategories = StoreCategory::all();

        return view('store.index', compact('allActiveStores', 'allCategories'));
    }

    
    public function create(Request $request, Store $store)
    {
        $this->authorize(StoreDiscountPolicy::REQUEST, new StoreDiscount());

        $isUserAllowedForMonthAndStore = StoreDiscount::isUserAllowedForThisStoreDiscountInCurrentMonth($store->storeID);

        return view('store.id', compact('store','isUserAllowedForMonthAndStore'));
    }

    public function store(Request $request, Store $store)
    {
        $this->authorize(StoreDiscountPolicy::REQUEST, new StoreDiscount());

        $isUserAllowedForMonthAndStore = StoreDiscount::isUserAllowedForThisStoreDiscountInCurrentMonth($store->storeID);
        abort_if(! $isUserAllowedForMonthAndStore, 403);

        $trackingCode = (int) (2 . mt_rand(1234569,9856492));
        while(StoreDiscount::query()->where('trackingCode', $trackingCode)->exists()){
            $trackingCode = (int) (1 . mt_rand(1234569,9856492));
        }

        $verification_one = 'waiting';
        $current_verification_state = 'waiting_one';

        StoreDiscount::query()->create([
            'userID' => auth()->user()->userID,
            'discountDate' => jalaliToGregorian(verta()->startMonth()->formatDate()),
            'storeID' => $store->storeID,
            'storeName' => $store->storeName,
            'UserName' => auth()->user()->name,
            'UserLastName' => auth()->user()->lastName,
            'UserNationalCode' => auth()->user()->nationalCode,
            'UserMobileNumber' => auth()->user()->mobileNumber,
            'UserEmployeeID' => auth()->user()->employeeID,
            'UserEmploymentTypeName' => auth()->user()->employmentType->employmentTypeName,
            'UserUnitName' => auth()->user()->unit->unitName,
            'trackingCode' => $trackingCode,
            'verification_one' => $verification_one,
            'current_verification_state' => $current_verification_state,
        ]);

        session()->put('trackingCode', $trackingCode);

        return to_route('store.discountinfo');
    }


    public function discountinfo()
    {
        $this->authorize(StoreDiscountPolicy::REQUEST, new StoreDiscount());

        if(! session()->has('trackingCode')){
            return to_route('store.mydiscounts');
        }
        session()->pull('trackingCode');

        return view('store.discountinfo');
    }

    public function mydiscounts()
    {
        $this->authorize(StoreDiscountPolicy::MYDISCOUNTS, new StoreDiscount());

        return view('store.mydiscounts');
    }




    public function letter(StoreDiscount $storeDiscount)
    {
        $this->authorize(StoreDiscountPolicy::LETTER, $storeDiscount);

        $userData = User::query()->findOrFail($storeDiscount->userID);

        return view('store.letter', compact('storeDiscount', 'userData'));
    }

}
