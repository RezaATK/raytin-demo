<?php

namespace App\Livewire\Administrator\Club\Clubs;

use App\Models\Club\Club;
use Livewire\Component;

class TableRow extends Component
{

    public Club $club;

    public $listeners = [
        'updated.{club.clubID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->club = $query->first();
    }

}
