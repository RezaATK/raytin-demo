<?php

namespace App\Livewire\Administrator\Store\Stores;

use App\Exports\StoresExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\Store\Store;
use App\Policies\Store\StorePolicy;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

#[Lazy]
class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'storeID';
    public string $selectedColumn = 'storeID';
    public string $primaryKey = 'storeID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [
        'status' => 'isActive',
    ];


    public function render(): View
    {
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $stores = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($stores->total());

        $this->currentPageIds = $stores->map(fn($store) => (string) $store->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('stores', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $store = new Store();
        if (! Gate::check(StorePolicy::DELETE, $store)) {
           $this->showOpUnauthorized();
           return;
       }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $store);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
        $store = new Store();
        if (! Gate::check(StorePolicy::EDIT, $store)) {
            $this->showOpUnauthorized();
            return;
        }

        $this->handleToggle($column, $id, $store);
    }


    public function export()
    {
        $store = new Store();
        if (! Gate::check(StorePolicy::EXPORT, $store)) {
            $this->showOpUnauthorized();
            return;
        }

        return (new StoresExport())->whereIn($this->ids)->download("StoreCategories-" . verta()->formatDate() . ".xlsx");
    }

    #[Computed]
    protected function searchQuery(): QueryBuilder|EloquentBuilder
    {
        return Store::query()
            ->select(
                'stores.storeID as storeID',
                'stores.storeName as storeName',
                'storecategory.categoryName as categoryName',
                'stores.storeNeighborhood as storeNeighborhood',
                'stores.isActive as isActive')
            ->join('storecategory', 'storecategory.storeCategoryID', '=', 'stores.storeCategoryID')
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny(['stores.storeName',
                    'storecategory.categoryName',
                    'stores.storeNeighborhood',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'storeName' => 'storeName',
            'storeDetails' => 'storeDetails',
            'categoryName' => 'categoryName',
            'storeNeighborhood' => 'storeNeighborhood',
            'status' => 'isActive',
            default => 'storeID',
        };
    }

}

