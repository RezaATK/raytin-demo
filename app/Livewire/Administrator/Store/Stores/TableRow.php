<?php

namespace App\Livewire\Administrator\Store\Stores;

use App\Models\Store\Store;
use Livewire\Component;

class TableRow extends Component
{

    public Store $store;

    public $listeners = [
        'updated.{store.storeID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->store = $query->first();
    }

}
