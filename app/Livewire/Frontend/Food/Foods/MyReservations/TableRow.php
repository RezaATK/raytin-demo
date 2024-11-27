<?php

namespace App\Livewire\Frontend\Food\Foods\MyReservations;

use App\Models\Food\FoodReservation;
use Livewire\Component;

class TableRow extends Component
{

    public FoodReservation $reserve;

    public function render()
    {
        return view('livewire.frontend.food.foods.my-reservations.table-row');
    }
}
