<?php

namespace App\Livewire\Administrator\Food\Foods;

use App\Models\Food\Food;
use Livewire\Component;

class TableRow extends Component
{

    public Food $food;

    public $listeners = [
        'updated.{food.foodID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->food = $query->first();
    }

}
