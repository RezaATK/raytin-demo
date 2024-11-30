<?php

namespace App\Livewire\Administrator;

use App\Enums\Toast;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Lazy]
abstract class BaseTableClass extends Component
{
    use withPagination;

    public ?string $search = null;
    public int $pageSize = 10;
    public ?int $pageNumber;
    public int $id;
    public string $primaryKey = 'id';
    public string $column = 'id';
    public string $selectedColumn = 'id';
    public bool $descSort = true;
    public int $category_id;
    public array $category_IDs = [];
    public $ids = [];
    public bool $hasIds = false;
    public string $placeholderPath = "livewire.loading";


    // protected abstract function searchQuery(): QueryBuilder|EloquentBuilder;
    protected abstract function searchQuery();

    protected abstract function getColumnForSort($column): string;

    #[On('deleteItems')]
    public abstract function delete(?int $id = null): void;

    public abstract function render(): View;

    public abstract function toggle(string $column, int $id): void;


    protected function handleToggle(string $column, int $id, Model $model): void
    {
        $column = $this->toggleable[$column] ?? null;

        throw_if(! $column, new \Exception('خطا'));

        $item = $model->query()->findOrFail($id);

        $item->update(["$column" => ! $item->{$column}]);

        $this->showOpSuccess();
    }

    public function handleDelete(array $ids, Model $model): void
    {
        $items = $model->query()->whereIn($this->primaryKey, $ids);
        if ($items->doesntExist()) {
            $this->showDeleteFailed();
            return;
        }

        $model->query()->whereIn($this->primaryKey, $ids)->delete();

        $this->showDeleteSuccess();

        $deleteItemsCount = count($ids);

        $this->calculateCurrentPage($deleteItemsCount);
    }


    // #[On('select')]
    // public function select(int $id = null): void
    // {
    //     if (! in_array($id, $this->ids)) {
    //         $this->ids[] = $id;
    //         $this->hasIds = true;
    //     } else {
    //         unset($this->ids[array_search($id, $this->ids)]);
    //         if (empty($this->ids)) {
    //             $this->hasIds = false;
    //         }
    //     }
    // }


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


    protected function resolveIds(?int $id = null): array
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


    public function searchUpdated(): void
    {
        $this->resetPage();
    }

    public function placeholder(){
        return  view($this->placeholderPath);
    }

}
