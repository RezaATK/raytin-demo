<?php

namespace App\Livewire\Administrator\Club\AllReservations;

use App\Models\Club\ClubReservations;
use Livewire\Component;

class ManageAllReservationsTableRowsBackup extends Component
{

    public ClubReservations $clubReservations;

    public $listeners = [
        'updated.{clubReservations.reservID}' => '$refresh',
    ];


    public function render()
    {
        return view('livewire.administrator.club.manage-all-reservations-table-rows');
    }

    public function approve(int $id): void
    {
//        $reserve = new ClubReservations();

//        if (! Gate::check('update', $reserve)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        ClubReservations::query()->where('reservID', $id)->update(['verification' => 'verified']);

        $this->dispatch("updated.{$id}")->self();
    }



    public function reject(int $id): void
    {
//        $reserve = new ClubReservations();

//        if (! Gate::check('update', $reserve)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        ClubReservations::query()->where('reservID', $id)->update(['verification' => 'rejected']);

        $this->dispatch("updated.{$id}")->self();
;
    }



}
