<?php

namespace App\Http\Controllers\Frontend\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\FoodReservationRequest;
use App\Models\Food\FoodReservation;
use App\Models\Food\Month;
use App\Policies\Food\FoodReservationPolicy;
use App\Repositories\FoodReservationsRepository;
use App\Services\FoodReservationService;
use App\Services\FoodReservationValidationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FoodReservationController extends Controller
{

    public function index()
    {
        Gate::authorize(FoodReservationPolicy::RESERVE, new FoodReservation());

        return to_route('food.reserve.create');
    }


    public function create(FoodReservationService $service)
    {
        Gate::authorize(FoodReservationPolicy::RESERVE, new FoodReservation());

        return view('food.reserve', $service->handle());
    }


    public function store(FoodReservationRequest $request, FoodReservationService $service)
    {
        Gate::authorize(FoodReservationPolicy::RESERVE, new FoodReservation());

        $foodReserveDatas = $service->handle();

        if(verta()->startMonth()->month === $request->month){
            $allowedFoodsForMonth = $foodReserveDatas->get('foodListForCurrentMonth');
            $allowedDaysForMonth = $foodReserveDatas->get('allowedDaysListForCurrentToReserve');
            $canReserveMonth = $foodReserveDatas->get('canReserveForCurrentMonth');
            $isAlreadyReserved = $foodReserveDatas->get('iscurrentMonthAlreadyReserved');
            $alreadyReservation = $foodReserveDatas->get('currentMonthReservation')?->pluck('reservDate');
        }else{
            $allowedFoodsForMonth = $foodReserveDatas->get('foodListForNextMonth');
            $allowedDaysForMonth = $foodReserveDatas->get('allowedDaysListForNextToReserve');
            $canReserveMonth = $foodReserveDatas->get('canReserveForNextMonth');
            $isAlreadyReserved = $foodReserveDatas->get('isNextMonthAlreadyReserved');
            $alreadyReservation = $foodReserveDatas->get('nextMonthReservation')?->pluck('reservDate');
        }
        $validation = new FoodReservationValidationService();

        $dateForValidate = $allowedDaysForMonth;
        if($isAlreadyReserved){
            $dateForValidate = $alreadyReservation->toArray();
        }

        $isValid = $validation->checkDataType($request->data, $dateForValidate, $allowedFoodsForMonth, true);
        if(! $isValid || ! $canReserveMonth){
            return to_route('food.reserve.create');
        }


        $finalData = collect();
        foreach($request->input('data') as $item){
            [$date, $foodID] = explode('*', $item);
            $foodData = $allowedFoodsForMonth->where('foodID', $foodID)->first();
                $finalData->add([
                    'date' => $date,
                    'monthID' => $request->month,
                    'foodData' => $foodData,
                ]);
        }

        $repository = new FoodReservationsRepository();

        if(! $isAlreadyReserved) {
            $repository->createReservationsForMonth($finalData, auth()->user()->userID);
        }else{
            $repository->updateReservationsForMonth($finalData, auth()->user()->userID);
        }

        return to_route('food.reserve.create')->with('success', 'success');
    }


    public function myreservations()
    {
        Gate::authorize(FoodReservationPolicy::MYRESERVATIONS, new FoodReservation());

        return view('food.myreservations');
    }
}
