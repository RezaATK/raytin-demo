<?php

namespace App\Livewire\Administrator\Club\AllReservations;

use App\Livewire\Administrator\BaseTableRowClass;
use App\Models\Club\ClubReservations;
use App\Policies\Club\ClubReservationPolicy;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class TableRow extends BaseTableRowClass
{

    public ClubReservations $clubReservations;

    public $listeners = [
        'updated.{clubReservations.reservID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }


    public function approve(int $id): void
    {
        if (! Gate::check(ClubReservationPolicy::APPROVE, new ClubReservations())) {
           $this->showOpUnauthorized();
           return;
        }

        $query = $this->itemUpdated($id, true);

        $query->update(['verification' => 'verified']);

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->clubReservations = $query->firstOrFail();
    }


    public function reject(int $id): void
    {
        if (! Gate::check(ClubReservationPolicy::REJECT, new ClubReservations())) {
            $this->showOpUnauthorized();
            return;
        }
 
        $query = $this->itemUpdated($id, true);

        $query->update(['verification' => 'rejected']);

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->clubReservations = $query->firstOrFail();
    }


    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;

        $query = ClubReservations::query()
            ->select(
                'club_reservation.reservID as reservID',
                'clubs.clubID as clubID',
                'users.userID as userID',
                'users.employeeID as employeeID',
                'users.name as name',
                'users.lastName as lastName',
                'users.nationalCode as nationalCode',
                'clubs.clubName as clubName',
                'clubs.genderSpecific as genderSpecific',
                'club_reservation.reservDate as reservDate',
                'club_reservation.secondayUserRelationship as secondayUserRelationship',
                'club_reservation.secondayUserName as secondaryUserName',
                'club_reservation.secondayUserLastName as secondayUserLastName',
                'club_reservation.secondayUserNationalCode as secondayUserNationalCode',
                'club_reservation.trackingCode as trackingCode',
                'club_reservation.verification as verification',
                'employment_types.employmentTypeName as employmentTypeName',
                'units.unitName as unitName')
            ->leftJoin('clubs', function($join){
                $join->on('clubs.clubID','=','club_reservation.clubID');
            })
            ->leftJoin('users',function($join){
                $join->on('users.userID','=','club_reservation.userID');
            })
            ->leftJoin('units',function($join){
                $join->on('users.unitID','=','units.unitID');
            })
            ->leftJoin('employment_types',function($join){
                $join->on('users.employmentTypeID','=','employment_types.employmentTypeID');
            })
            ->where('reservID', $id);

            if($withReturn){
                return $query;
            }

        $this->clubReservations = $query->first();
    }

}
