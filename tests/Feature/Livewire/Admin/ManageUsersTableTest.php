<?php

use App\Livewire\Administrator\User\manage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(manage::class)
        ->assertStatus(200);
});
