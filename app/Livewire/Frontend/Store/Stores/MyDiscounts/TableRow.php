<?php

namespace App\Livewire\Frontend\Store\Stores\MyDiscounts;

use App\Models\Store\StoreDiscount;
use Livewire\Component;

class TableRow extends Component
{

    public StoreDiscount $discount;


    public function render()
    {
        return view('livewire.' . $this->__name);
    }

}
