<?php

namespace App\Livewire\Frontend\Club\Clubs\MyReservations;

use App\Models\Club\ClubReservations;
use Livewire\Component;

class TableRow extends Component
{

    public ClubReservations $reserve;


    public function render()
    {
        return view('livewire.' . $this->__name);
    }

}
