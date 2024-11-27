<?php

namespace App\Services;

use App\Models\Food\FoodReservation;
use App\Repositories\FoodReservationsRepository;

class FoodReservationService
{
    protected array $currentMonthStartAndEndDays = [];
    protected array $nextMonthStartAndEndDays = [];


    public function __construct() {
        $this->currentMonthStartAndEndDays = [
            verta()->startMonth()->formatDate(),
            verta()->endMonth()->formatDate()
        ];
        $this->nextMonthStartAndEndDays = [
            verta()->addMonth()->startMonth()->formatDate(),
            verta()->addMonth()->endMonth()->formatDate()
        ];
    }

    public function handle()
    {
        $isThereCurrentMonthReservations = FoodReservation::hasReservationsInMonth(
            $this->currentMonthStartAndEndDays[0],$this->currentMonthStartAndEndDays[1]
        );
        $isThereNextMonthReservations = FoodReservation::hasReservationsInMonth(
            $this->nextMonthStartAndEndDays[0], $this->nextMonthStartAndEndDays[1]
        );

            return collect($this->process($isThereCurrentMonthReservations, $isThereNextMonthReservations));

    }

    private function process($isThereCurrentMonthReservations, $isThereNextMonthReservations): array
    {
        $repository = new FoodReservationsRepository();
        $generateDatesService = new AllowedDaysForFoodReservationService();

        $foodListForCurrentMonth = $repository->getFoodDataForMonth(verta()->startMonth()->month);
        $foodListForNextMonth = $repository->getFoodDataForMonth(verta()->startMonth()->addMonth()->month);


        $canReserveForCurrentMonth = null;
        $canReserveForNextMonth = null;
        ///
        $currentMonthReservation = null;
        $nextMonthReservation = null;
        $allowedDaysListForCurrentToReserve = null;
        $allowedDaysListForNextToReserve = null;

        /////
        $iscurrentMonthAlreadyReserved = true;
        $isNextMonthAlreadyReserved = true;

        ////
        $canChangeNextMonth =  (verta()->day <= 25) ? true : false;

        if (($isThereCurrentMonthReservations) && ($isThereNextMonthReservations)) {
            $canReserveForCurrentMonth = false;
            $canReserveForNextMonth = ($canChangeNextMonth) ? true : false;

            $currentMonthReservation = $repository->getReservationsDataForMonth($this->currentMonthStartAndEndDays, auth()->user()->userID);
            $nextMonthReservation = $repository->getReservationsDataForMonth($this->nextMonthStartAndEndDays, auth()->user()->userID);

            $iscurrentMonthAlreadyReserved = true;
            $isNextMonthAlreadyReserved = true;
            $canChangeNextMonth = $canChangeNextMonth;
        }

        if (($isThereCurrentMonthReservations) && (! $isThereNextMonthReservations)) {
            $canReserveForCurrentMonth = false;
            $canReserveForNextMonth = ($canChangeNextMonth) ? true : false;

            $currentMonthReservation = $repository->getReservationsDataForMonth($this->currentMonthStartAndEndDays, auth()->user()->userID);
            $allowedDaysListForNextToReserve = $generateDatesService->getNextMonthAllowedDays();
            $iscurrentMonthAlreadyReserved = true;
            $isNextMonthAlreadyReserved = false;
            $canChangeNextMonth = $canChangeNextMonth;
        }

        if ((! $isThereCurrentMonthReservations) && (! $isThereNextMonthReservations)) {
            $canReserveForCurrentMonth = true;
            $canReserveForNextMonth = true;


            $allowedDaysListForCurrentToReserve = $generateDatesService->getCurrentMonthAllowedDays();
            $allowedDaysListForNextToReserve = $generateDatesService->getNextMonthAllowedDays();

            $iscurrentMonthAlreadyReserved = false;
            $isNextMonthAlreadyReserved = false;
            $canChangeNextMonth = $canChangeNextMonth;
        }

        if ((! $isThereCurrentMonthReservations) && ($isThereNextMonthReservations)) {
            $canReserveForCurrentMonth = true;
            $canReserveForNextMonth = ($canChangeNextMonth) ? true : false;

            $allowedDaysListForCurrentToReserve = $generateDatesService->getCurrentMonthAllowedDays();
            $nextMonthReservation = $repository->getReservationsDataForMonth($this->nextMonthStartAndEndDays, auth()->user()->userID);

            $iscurrentMonthAlreadyReserved = false;
            $isNextMonthAlreadyReserved = true;
            $canChangeNextMonth = $canChangeNextMonth;
        }

        return [
            'foodListForCurrentMonth' => $foodListForCurrentMonth,
            'foodListForNextMonth' => $foodListForNextMonth,
            'currentMonthReservation' => $currentMonthReservation,
            'nextMonthReservation' => $nextMonthReservation,
            'iscurrentMonthAlreadyReserved' => $iscurrentMonthAlreadyReserved,
            'isNextMonthAlreadyReserved' => $isNextMonthAlreadyReserved,
            'allowedDaysListForCurrentToReserve' => $allowedDaysListForCurrentToReserve,
            'allowedDaysListForNextToReserve' => $allowedDaysListForNextToReserve,
            'canChangeNextMonth' => $canChangeNextMonth,
            'canReserveForCurrentMonth' => $canReserveForCurrentMonth,
            'canReserveForNextMonth' => $canReserveForNextMonth,
        ];
    }
}