<?php

use App\Livewire\Administrator\BaseTableRowClass;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(BaseTableRowClass::class)
        ->assertStatus(200);
});
