<?php

namespace App\Livewire\Frontend;

use App\Enums\Toast;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

//use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
//use Illuminate\Database\Query\Builder as QueryBuilder;

#[Lazy]
abstract class TableSimpleBaseClass extends Component
{
    use withPagination;

    public ?string $search = null;
    public int $pageSize = 10;
    public ?int $pageNumber;
    public int $id;
    protected string $primaryKey = 'id';
    public string $column = 'id';
    public string $selectedColumn = 'id';
    public bool $descSort = true;
    public int $category_id;
    public array $category_IDs = [];
    // public array $ids = [];
    public $ids = [];
    public bool $hasIds = false;


    // protected abstract function searchQuery(): QueryBuilder|EloquentBuilder;
    protected abstract function searchQuery();

    protected abstract function getColumnForSort($column): string;

    public abstract function render(): View;


    public function calculateCurrentPage($items = 1): void
    {
        $this->pageNumber = $this->paginators['page'];

        if ((session($this->__name . '-total-items') - $items) % $this->pageSize === 0) {
            $this->pageNumber = --$this->pageNumber;

            $this->gotoPage($this->pageNumber);
        }
    }


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


    protected function resolveIds(?int $id): array
    {
        if (! $id) {
            $ids = $this->ids;
            $this->hasIds = ! $this->hasIds;
            $this->ids = [];
        } else {
            $ids = [$id];
        }

        return $ids;
    }



    protected function setTotalItemsInSession(mixed $ItemCollectionCount): void
    {
        session()->put($this->__name . '-total-items', $ItemCollectionCount);
    }


    protected function sortTerms($query)
    {
        $sort = $this->descSort ? 'desc' : 'asc';

        return $query->orderBy($this->column, $sort);
    }


    public function sort($column): void
    {
        $this->selectedColumn = $column;
        $column = $this->getColumnForSort($column);

        if ($this->column == $column) {
            $this->descSort = ! $this->descSort;
        } else {
            $this->column = $column;
            $this->descSort = false;
        }
    }


    public function searchFor(): void
    {
        $this->resetPage();
    }


    // public function placeholder(){
    //     return  view('livewire.loading');
    // }

}
