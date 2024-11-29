<?php

namespace App\Livewire\Administrator\Food\Foods;

use App\Exports\FoodsExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\Food\Food;
use App\Policies\Food\FoodPolicy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;

class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'foodID';
    public string $selectedColumn = 'foodID';
    public string $primaryKey = 'foodID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [
        'status' => 'isActive',
    ];

    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $foods = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($foods->total());

        $this->currentPageIds = $foods->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('foods', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $food = new Food();
        if (! Gate::check(FoodPolicy::DELETE, $food)) {
            $this->showOpUnauthorized();
            return;
        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $food);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
        $food = new Food();
        if (! Gate::check(FoodPolicy::EDIT, $food)) {
            $this->showOpUnauthorized();
            return;
        }

        $this->handleToggle($column, $id, $food);
    }


    public function export()
    {
        $food = new Food();
        if (! Gate::check(FoodPolicy::EXPORT, $food)) {
            $this->showOpUnauthorized();
            return;
        }

       return (new FoodsExport())->whereIn($this->ids)->download("foods-" . verta()->formatDate() . ".xlsx");
    }

    
    #[Computed]
    protected function searchQuery()
    {
        return Food::query()
            ->select(
                'foods.foodID as foodID',
                'foods.foodName as foodName',
                'foods.foodPrice as foodPrice',
                'foodcategory.categoryName as categoryName',
                'foods.isActive as isActive')
            ->join('foodcategory', 'foodcategory.foodCategoryID', '=', 'foods.foodCategoryID')
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny(['foods.foodName',
                    'foodcategory.categoryName',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'foodName' => 'foods.foodName',
            'foodPrice' => 'foods.foodPrice',
            'categoryName' => 'foodcategory.categoryName',
            'isActive' => 'foods.isActive',
            'status' => 'isActive',
            default => 'storeID',
        };
    }
}
