<?php

namespace App\Services;

class AllowedDaysForFoodReservationService
{
    protected array $excludedDates;

    public function __construct()
    {
        // TODO
        $this->excludedDates = [];
    }


    public function getCurrentMonthAllowedDays()
    {
        $currentMonthAllowedDays = [];
        $datetime = verta();
        $currentYear = $datetime->format("Y");
        $currentMonth = $datetime->format("m");
        $currentDay = $datetime->format("d");

        $daysInMonth = verta()->daysInMonth;

        if($currentDay < 10) {
            $startDay = 10;
            $daysInMonth = $daysInMonth - $startDay;
            for($i = 0; $i <= $daysInMonth; $i++) {
                $currentMonthAllowedDays[$i] = "{$currentYear}-{$currentMonth}-{$startDay}";
                $startDay = ++$startDay;
            }
        }
        if( $currentDay >= 10 && $currentDay < 20) {
            $startDay = 20;
            $daysInMonth = $daysInMonth - $startDay;
            for($i = 0; $i <= $daysInMonth; $i++) {
                $currentMonthAllowedDays[$i] = "{$currentYear}-{$currentMonth}-{$startDay}";
                $startDay = ++$startDay;
            }
        }
        if($currentDay >= 20) {
            $currentMonthAllowedDays = null;
        }

        $allowedDays = [];
        if($currentMonthAllowedDays == null){
            return $currentMonthAllowedDays;
        }


        foreach ($currentMonthAllowedDays as $day) {
            $dayInGregorian = jalaliToGregorian($day);
            // if(!verta($dayInGregorian)->isFriday() && !verta($dayInGregorian)->isThursday()){
            if(!verta($dayInGregorian)->isWeekend()){
                $allowedDays[] = $dayInGregorian;
            }
        }

        $finalAllowedDays = [];
        foreach ($allowedDays as $day) {
            if(! in_array($day, $this->excludedDates)){
                $finalAllowedDays[] = $day;
            }
        }


        return $finalAllowedDays;
    }
    public function getNextMonthAllowedDays()
    {
        $nextMonthFirstDay = verta()->startMonth()->addMonth();
        $nextMonthAllDays = $nextMonthFirstDay->daysInMonth; // returns days of the next month

        $nextMonthAllowedDays = [];

        for($i = 0; $i < $nextMonthAllDays; $i++) {
            $current = verta($nextMonthFirstDay)->addDays($i);
            // if($current->isFriday() || $current->isThursday()){
            if($current->isWeekend()){
                continue;
            }
            $nextMonthAllowedDays[] = $current->format("Y-n-j");
        }

        $allowedDays = [];
        foreach ($nextMonthAllowedDays as $day) {
            $allowedDays[] = jalaliToGregorian($day);
        }

        $finalAllowedDays = [];
        foreach ($allowedDays as $day) {
            if(! in_array($day, $this->excludedDates)){
                $finalAllowedDays[] = $day;
            }
        }


        return $finalAllowedDays;
    }
}