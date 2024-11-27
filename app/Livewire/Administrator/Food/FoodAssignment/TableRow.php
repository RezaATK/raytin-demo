<?php

namespace App\Livewire\Administrator\Food\FoodAssignment;

use App\Models\Food\Month;
use Livewire\Component;

class TableRow extends Component
{

    public Month $month;

    public $listeners = [
        'updated.{month.monthID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->month = $query->first();
    }

}
