<?php

namespace App\Livewire\Administrator\StoreCategory;

use App\Exports\StoreCategoriesExport;
use App\Exports\StoreCategorysExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\Store\StoreCategory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'storeCategoryID';
    public string $selectedColumn = 'storeCategoryID';
    public string $primaryKey = 'storeCategoryID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [];



    public function render(): View
    {
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $storeCategories = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($storeCategories->total());

        $this->currentPageIds = $storeCategories->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('storeCategories', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $clubCategory = new StoreCategory();
//        if (! Gate::check('delete', $clubCategory)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $clubCategory);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
//        $clubCategory = new StoreCategory();

//        if (! Gate::check('update', $clubCategory)) {
//            $this->showOpUnauthorized();
//            return;
//        }

//        $this->handleToggle($column, $id, $clubCategory);
    }


    public function export()
    {
       return (new StoreCategoriesExport())
                ->whereIn($this->ids)
                ->download("StoreCategories-" . verta()->formatDate() . ".xlsx");

    }

    #[Computed]
    protected function searchQuery()
    {
        return StoreCategory::query()
            ->select('storeCategoryID','categoryName')
            ->when($this->search, function ($query) {
                $query->where('categoryName', 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'categoryName' => 'categoryName',
            default => 'storeCategoryID',
        };
    }


}
