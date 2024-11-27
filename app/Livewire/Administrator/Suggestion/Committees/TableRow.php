<?php

namespace App\Livewire\Administrator\Suggestion\Committees;

use App\Models\Suggestion\SuggestionsCommittee;
use Livewire\Component;

class TableRow extends Component
{

    public SuggestionsCommittee $committee;

    public function render()
    {
        return view('livewire.' . $this->__name);
    }
}
