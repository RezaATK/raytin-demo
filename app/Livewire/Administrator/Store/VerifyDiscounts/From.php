<?php

namespace App\Livewire\Administrator\Store\VerifyDiscounts;

use App\Models\Store\StoreDiscount;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class From extends Form
{
    public $storeDiscount;

    #[Validate('required|max:255')]
    public $additionalNote = '';


    public function setInit($storeDiscount)
    {
        $this->storeDiscount = $storeDiscount;
        $this->additionalNote = $this->storeDiscount->additionalNote;
    }

    public function update()
    {


//        $this->validate();

        $this->storeDiscount->update([
            'additionalNote' => $this->additionalNote,
        ]);

    }
}
