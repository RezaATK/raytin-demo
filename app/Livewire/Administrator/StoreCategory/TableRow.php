<?php

namespace App\Livewire\Administrator\StoreCategory;

use App\Models\Store\StoreCategory;
use Livewire\Component;

class TableRow extends Component
{

    public StoreCategory $storeCategory;

    public $listeners = [
        'updated.{storeCategory.storeCategoryID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->storeCategory = $query->first();
    }

}
