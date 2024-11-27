<?php

namespace App\Livewire\Administrator\Suggestion\Suggestions;

use App\Livewire\Administrator\BaseTableRowClass;
use App\Models\Suggestion\Suggestion;
use Livewire\Component;

class TableRow extends BaseTableRowClass
{

    public Suggestion $suggestion;

    public function render()
    {
        return view('livewire.' . $this->__name);
    }

}
