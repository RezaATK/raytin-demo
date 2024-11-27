<?php

namespace App\Livewire\Administrator;

use App\Enums\Toast;
use App\Models\Club\ClubReservations;
use Livewire\Attributes\On;
use Livewire\Component;

class BaseTableRowClass extends Component
{

    protected function showDeleteFailed(): void
    {
        $this->toast(Toast::FailedDelete, Toast::RedIcon, Toast::RedTimer);
    }

    protected function showDeleteSuccess(): void
    {
        $this->toast(Toast::SuccessDelete, Toast::GreenIcon);
    }


    protected function showOpFailed(): void
    {
        $this->toast(Toast::FailedOp, Toast::RedIcon, Toast::RedTimer);

    }

    protected function showOpSuccess(): void
    {
        $this->toast(Toast::SuccessOp, Toast::GreenIcon);
    }


    protected function showOpUnauthorized(): void
    {
        $this->toast(Toast::UnAuthorized, Toast::RedIcon);
    }


    protected function toast(string $title, string $icon, ?int $timer = Toast::GreenTimer): void
    {
        $this->dispatch('toastMessage', [
            'title' => $title,
            'icon' => $icon,
            'timer' => $timer
        ]);
    }


}
