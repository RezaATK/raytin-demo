<?php

namespace App\Livewire\Administrator\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class TableRow extends Component
{

    public Role $role;

    public $listeners = [
        'updated.{role.id}' => '$refresh',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->role = $query->first();
    }

}
