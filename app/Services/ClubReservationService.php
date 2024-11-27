<?php

namespace App\Services;

use App\Models\Club\ClubReservations;
use App\Models\User\User;
use Illuminate\Support\Carbon;

class ClubReservationService
{

    public function checkUserReservations(int $userID)
    {

//        $familyCount = count($familyCleanList);
//
//        $userReservesForCurrentMonth = ClubReservations::query()->userRelatedReservesForMonth($currentMonth);
//        $userReservesForNextMonth = ClubReservations::query()->userRelatedReservesForMonth($nextMonth);
//
//        $isUserAllowedToReservCurrentMonth = ($userReservesForCurrentMonth === $familyCount) ? false : true;
//        $isUserAllowedToReservNextMonth = ($userReservesForNextMonth === $familyCount) ? false : true;


        $wholeUserFamilyData = $this->getFamilyMembers($userID);

        $currentMonth = jalaliToGregorian(verta()->now()->startMonth()->formatDate());
        $nextMonth = jalaliToGregorian(verta()->now()->startMonth()->addMonth()->formatDate());

        $currentMonthElem = 'hasCurrentActiveReserv';
        $nextMonthElem = 'hasNextActiveReserv';

        $wholeUserFamilyData = $this->checkForEachMonthReservations($wholeUserFamilyData, $currentMonth, $currentMonthElem);
        $wholeUserFamilyData = $this->checkForEachMonthReservations($wholeUserFamilyData, $nextMonth, $nextMonthElem);


        return $this->checkForMaxReserveBaseOnFamilyCount($wholeUserFamilyData, [$currentMonth, $nextMonth]);

    }



    public function getFamilyMembers(int $userID)
    {
        $userDataWithCount = User::query()->withCount('family')->findOrFail($userID);
        $familyMembersData = $userDataWithCount->family;
        $familyMembersCount = $userDataWithCount->family_count + 1;

        $father = 'پدر';
        $mother = 'مادر';
        $relations = [$father, $mother];
        $ageLimit = 5;

        $wholeUserFamilyData = [];

        $wholeUserFamilyData[0]['userID'] = $userDataWithCount->userID;
        $wholeUserFamilyData[0]['name'] = $userDataWithCount->name;
        $wholeUserFamilyData[0]['lastName'] = $userDataWithCount->lastName;
        $wholeUserFamilyData[0]['mobileNumber'] = $userDataWithCount->mobileNumber;
        $wholeUserFamilyData[0]['nationalCode'] = $userDataWithCount->nationalCode;
        $wholeUserFamilyData[0]['familyMemberName'] = $userDataWithCount->name;
        $wholeUserFamilyData[0]['familyMemberLastName'] = $userDataWithCount->lastName;
        $wholeUserFamilyData[0]['familyMemberNationalCode'] = $userDataWithCount->nationalCode;
        $wholeUserFamilyData[0]['familyMemberMobileNumber'] = $userDataWithCount->mobileNumber;
        $wholeUserFamilyData[0]['familyMemberGender'] = $userDataWithCount->gender;
        $wholeUserFamilyData[0]['familyMemberBirthday'] = $userDataWithCount->birthday;
        $wholeUserFamilyData[0]['familyMemberRelationship'] = 'شخص کارمند';
        $wholeUserFamilyData[0]['hasCurrentActiveReserv'] = false;
        $wholeUserFamilyData[0]['hasNextActiveReserv'] = false;
        $wholeUserFamilyData[0]['isUserAllowedToReservCurrentMonth'] = true;
        $wholeUserFamilyData[0]['isUserAllowedToReservNextMonth'] = true;


        if($familyMembersCount > 1){
            foreach($familyMembersData as $i => $familyMember){
                $i = ++$i;
                $wholeUserFamilyData[$i]['userID'] = $userDataWithCount->userID;
                $wholeUserFamilyData[$i]['name'] = $userDataWithCount->name;
                $wholeUserFamilyData[$i]['lastName'] = $userDataWithCount->lastName;
                $wholeUserFamilyData[$i]['mobileNumber'] = $userDataWithCount->mobileNumber;
                $wholeUserFamilyData[$i]['nationalCode'] = $userDataWithCount->nationalCode;
                $wholeUserFamilyData[$i]['familyMemberName'] = $familyMember->familyMemberName;
                $wholeUserFamilyData[$i]['familyMemberLastName'] = $familyMember->familyMemberLastName;
                $wholeUserFamilyData[$i]['familyMemberNationalCode'] = $familyMember->familyMemberNationalCode;
                $wholeUserFamilyData[$i]['familyMemberMobileNumber'] = $familyMember->familyMemberMobileNumber;
                $wholeUserFamilyData[$i]['familyMemberGender'] = $familyMember->familyMemberGender;
                $wholeUserFamilyData[$i]['familyMemberBirthday'] = $familyMember->familyMemberBirthday;
                $wholeUserFamilyData[$i]['familyMemberRelationship'] = $familyMember->familyMemberRelationship;
                $wholeUserFamilyData[$i]['hasCurrentActiveReserv'] = false;
                $wholeUserFamilyData[$i]['hasNextActiveReserv'] = false;
                $wholeUserFamilyData[$i]['isUserAllowedToReservCurrentMonth'] = true;
                $wholeUserFamilyData[$i]['isUserAllowedToReservNextMonth'] = true;
            }
        }

        return $this->excludes($wholeUserFamilyData, $relations, $ageLimit);
    }



    protected function excludes($wholeUserFamilyData, array $relations, int $ageLimit = 5)
    {

        $wholeUserFamilyData = $this->ExcludeForSpecificRelations($wholeUserFamilyData, $relations);

        return $this->ExcludeLittleChildern($wholeUserFamilyData, $ageLimit);

    }



    protected function ExcludeLittleChildern($wholeUserFamilyData, $ageLimit = 5)
    {
        for ($i = 0; $i < count($wholeUserFamilyData); $i++)
        {
            $date = explode('-', $wholeUserFamilyData[$i]['familyMemberBirthday']);
            $Born = Carbon::create($date[0], $date[1],$date[2]);
            $Age = $Born->diff(Carbon::now())->y;
            if($Age < $ageLimit){
                unset($wholeUserFamilyData[$i]);
            }
        }
        return array_values($wholeUserFamilyData);
    }



    protected function ExcludeForSpecificRelations($wholeUserFamilyData, array $relations)
    {
        for($j = 0; $j < count($relations); $j++){
            for ($i = 0; $i < count($wholeUserFamilyData); $i++)
            {
                if($wholeUserFamilyData[$i]['familyMemberRelationship'] == $relations[$j]){
                    unset($wholeUserFamilyData[$i]);
                }
            }
            $wholeUserFamilyData =  array_values($wholeUserFamilyData);
        }

        return $wholeUserFamilyData;
    }



    protected function checkForEachMonthReservations($wholeUserFamilyData, string $date, string $reserveElementInArray)
    {
        $userReservationsForMonth = ClubReservations::query()->whereUserHasReservationForDate($date)->get();

        if($userReservationsForMonth) {
            for ($i = 0; $i < count($wholeUserFamilyData); $i++) {
                for($j = 0; $j < count($userReservationsForMonth); $j++) {
                    if ($userReservationsForMonth[$j]->secondayUserNationalCode == $wholeUserFamilyData[$i]['familyMemberNationalCode']) {
                        $wholeUserFamilyData[$i][$reserveElementInArray] = true;
                    }
                }
            }
        }

        return $wholeUserFamilyData;
    }


    protected function checkForMaxReserveBaseOnFamilyCount($wholeUserFamilyData, array $dates)
    {
        $familyCount = count($wholeUserFamilyData);

        $userReservesForCurrentMonth = ClubReservations::query()->userRelatedReservesForMonth($dates[0]);
        $userReservesForNextMonth = ClubReservations::query()->userRelatedReservesForMonth($dates[1]);

        $isUserAllowedToReservCurrentMonth = ($userReservesForCurrentMonth === $familyCount) ? false : true;
        $isUserAllowedToReservNextMonth = ($userReservesForNextMonth === $familyCount) ? false : true;


        for ($i = 0; $i < count($wholeUserFamilyData); $i++) {
            $wholeUserFamilyData[$i]['isUserAllowedToReservCurrentMonth'] = $isUserAllowedToReservCurrentMonth;
            $wholeUserFamilyData[$i]['isUserAllowedToReservNextMonth'] = $isUserAllowedToReservNextMonth;
        }

        return $wholeUserFamilyData;

    }

}