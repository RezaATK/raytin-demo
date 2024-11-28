<?php

namespace App\Http\Controllers\Frontend\Club;

use App\Http\Controllers\Controller;
use App\Models\Club\Club;
use App\Models\Club\ClubCategory;
use App\Models\Club\ClubReservations;
use App\Models\User\User;
use App\Policies\Club\ClubReservationPolicy;
use App\Services\ClubReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class ClubReservationController extends Controller
{

    public function index()
    {
        Gate::authorize(ClubReservationPolicy::RESERVE, new ClubReservations());

        $allActiveClubs = Club::with('category')->where('isActive', '=', 1)->get();

        $allCategories = ClubCategory::all();

        return view('club.index', compact('allActiveClubs', 'allCategories'));
    }

    public function create(Club $club)
    {
        Gate::authorize(ClubReservationPolicy::RESERVE, new ClubReservations());

        $familyCleanList = (new ClubReservationService())->checkUserReservations(auth()->user()->userID);
        if(isset($familyCleanList[0]['isUserAllowedToReservCurrentMonth']) && ! $familyCleanList[0]['isUserAllowedToReservCurrentMonth']){
            $isUserAllowedToReservCurrentMonth = false;
        }

        if(isset($familyCleanList[0]['isUserAllowedToReservNextMonth']) && ! $familyCleanList[0]['isUserAllowedToReservNextMonth']){
            $isUserAllowedToReservNextMonth = false;
        }

        $club->load('category');
        return view('club.id', [
                'club' => $club,
                'familyCleanList' => $familyCleanList,
                'isUserAllowedToReservCurrentMonth' => $isUserAllowedToReservCurrentMonth ?? true,
                'isUserAllowedToReservNextMonth' => $isUserAllowedToReservNextMonth ?? true,
            ]);
    }


    public function store(Request $request, Club $club)
    {
        Gate::authorize(ClubReservationPolicy::RESERVE, new ClubReservations());

        if(! $request->currentMonthReserve && ! $request->nextMonthReserve){
            // log
            return redirect()->back();
        }

        $familyCleanList = (new ClubReservationService())->checkUserReservations(auth()->user()->userID);
        $chosenUserFamilyIndex = null;

        if($request->currentMonthReserve){
            $selectedUserNationalCode = $request->currentMonthReserve;
            foreach($familyCleanList as $familyMember){
                if($familyMember['familyMemberNationalCode'] === $selectedUserNationalCode){
                    $chosenUserFamilyIndex = $familyMember;
                }
            }
            $reserveDate = jalaliToGregorian(verta()->now()->startMonth()->formatDate());
        }else{
            $selectedUserNationalCode = $request->nextMonthReserve;
            foreach($familyCleanList as $familyMember){
                if($familyMember['familyMemberNationalCode'] === $selectedUserNationalCode){
                    $chosenUserFamilyIndex = $familyMember;
                }
            }
            $reserveDate = jalaliToGregorian(verta()->now()->startMonth()->addMonth()->formatDate());
        }

        abort_if(! $chosenUserFamilyIndex, 403);


        if($chosenUserFamilyIndex['familyMemberGender'] == 'male' && $club->genderSpecific === 'بانوان'){
            return redirect()->back()->with('failed', 'این باشگاه ویژه بانوان می باشد');
        }

        if($chosenUserFamilyIndex['familyMemberGender'] == 'female' && $club->genderSpecific === 'آقایان'){
            return redirect()->back()->with('failed', 'این باشگاه ویژه آقایان می باشد');
        }


        $trackingCode = (int) (1 . mt_rand(1234569,9856492));
        while(ClubReservations::query()->where('trackingCode', $trackingCode)->exists())
        {
            $trackingCode = (int) (1 . mt_rand(1234569,9856492));
        }

        $carbon = new Carbon();
        ClubReservations::create([
            'userID' => auth()->user()->userID,
            'clubID' => $club->clubID,
            'clubName' => $club->clubName,
            'genderSpecific' => $club->genderSpecific,
            'reservDate' => $reserveDate,
            'PrimaryUserName' => $chosenUserFamilyIndex['name'],
            'PrimaryUserLastName' => $chosenUserFamilyIndex['lastName'],
            'primaryUserNationalCode' => $chosenUserFamilyIndex['nationalCode'],
            'primaryUserMobileNumber' => $chosenUserFamilyIndex['mobileNumber'],
            'secondayUserName' => $chosenUserFamilyIndex['familyMemberName'],
            'secondayUserLastName' => $chosenUserFamilyIndex['familyMemberLastName'],
            'secondayUserNationalCode' => $chosenUserFamilyIndex['familyMemberNationalCode'],
            'secondayUserRelationship' => $chosenUserFamilyIndex['familyMemberRelationship'],
            'secondayUserMobileNumber' => $chosenUserFamilyIndex['familyMemberMobileNumber'],
            'secondayUserGender' => $chosenUserFamilyIndex['familyMemberGender'] ?? '',
            'trackingCode' => $trackingCode,
            'verification' => 'pending',
            'reserved_At' => $carbon->format('Y-m-d'),
        ]);

        session()->put('trackingCode', $trackingCode);

        return to_route('club.reserveinfo');

    }


    public function reserveinfo()
    {
        Gate::authorize(ClubReservationPolicy::RESERVE, new ClubReservations());

        if(! session()->has('trackingCode')){
            return to_route('store.myreservations');
        }

        session()->pull('trackingCode');

        return view('club.reserveinfo');
    }


    public function myreservations()
    {
        Gate::authorize(ClubReservationPolicy::MYRESERVATIONS, new ClubReservations());

        return view('club.myreservations');
    }


    public function letter(ClubReservations $clubReservations)
    {
        Gate::authorize(ClubReservationPolicy::MYRESERVATIONS, new ClubReservations());

        $userData = User::query()->findOrFail($clubReservations->userID);

        return view('club.letter', compact('clubReservations', 'userData'));
    }


}
