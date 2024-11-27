<?php

namespace App\Livewire\Administrator\User;

use App\Models\User\User;
use Livewire\Component;

class TableRow extends Component
{

    public User $user;

    public $listeners = [
        'updated.{user.userID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }



    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;


//        $this->user = $query->first();
    }

}
