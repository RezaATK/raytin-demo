<?php

namespace App\Http\Controllers\Frontend\Letter;

use App\Http\Controllers\Controller;
use App\Models\Club\ClubReservations;
use App\Models\Store\StoreDiscount;
use Illuminate\Http\Request;

class AllLettersController extends Controller
{
    public function create()
    {
        return view('letter.id');
    }

    public function store(Request $request)
    {
        $clubReservations = ClubReservations::query()->where('trackingCode', $request->trackingCode)->first();
        if($clubReservations){
            session()->put($clubReservations->trackingCode, true);
            return to_route('letter.show', $clubReservations->trackingCode);    
        }
        $storeDiscount = StoreDiscount::query()->where('trackingCode', $request->trackingCode)->first();
        if($storeDiscount){
            session()->put($storeDiscount->trackingCode, true);
            return to_route('letter.show', $storeDiscount->trackingCode);    
        }
        return to_route('letter.create')->with('failed','کد رهگیری اشتباه است.');
    }


    public function show($trackingCode)
    {
        $clubReservations = ClubReservations::query()->where('trackingCode', $trackingCode)->first();
        if($clubReservations){
            session()->forget($trackingCode);
            return view('letter.club', ['clubReservations' => $clubReservations]);    
        }
        $storeDiscount = StoreDiscount::query()->where('trackingCode', $trackingCode)->first();
        if($storeDiscount){
            session()->forget($trackingCode);
            return view('letter.store', ['storeDiscount' => $storeDiscount]);    
        }

        return to_route('letter.create')->with('failed','کد رهگیری اشتباه است.');
    }
}
