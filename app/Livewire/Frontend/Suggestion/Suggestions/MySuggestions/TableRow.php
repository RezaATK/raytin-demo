<?php

namespace App\Livewire\Frontend\Suggestion\Suggestions\MySuggestions;

use App\Models\Suggestion\Suggestion;
use Livewire\Component;

class TableRow extends Component
{

    public Suggestion $suggestion;


    public function render()
    {
        return view('livewire.' . $this->__name);
    }

}
