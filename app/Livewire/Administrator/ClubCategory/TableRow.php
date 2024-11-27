<?php

namespace App\Livewire\Administrator\ClubCategory;

use App\Models\Club\ClubCategory;
use Livewire\Component;

class TableRow extends Component
{

    public ClubCategory $clubCategory;

    public $listeners = [
        'updated.{clubCategory.clubCategoryID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->clubCategory = $query->first();
    }

}
