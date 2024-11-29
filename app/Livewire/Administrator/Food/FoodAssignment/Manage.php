<?php

namespace App\Livewire\Administrator\Food\FoodAssignment;

use App\Exports\FoodAssignmentExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\Food\Food;
use App\Models\Food\Month;
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

    public string $column = 'monthID';
    public string $selectedColumn = 'monthID';
    public string $primaryKey = 'monthID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [
        'status' => 'isActive',
    ];
    public int $pageSize = 12;
    public bool $descSort = false;


    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $months = $query->paginate($this->pageSize);
        $this->setTotalItemsInSession($months->total());

        $this->currentPageIds = $months->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('months', 'categories'));
    }


    public function delete(?int $id = null): void
    {
    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
        $month = new Month();

//        if (! Gate::check('update', $month)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        $this->handleToggle($column, $id, $month);
    }


    public function export()
    {
        // todo!
        // $food = new Food();
        // if (! Gate::check(FoodPolicy::foodAssignmentExport, $food)) {
        //     $this->showOpUnauthorized();
        //     return;
        // }
        // return (new FoodAssignmentExport())->whereIn($this->ids)->download("foods-months-" . verta()->formatDate() . ".xlsx");
    }

    #[Computed]
    protected function searchQuery()
    {
        return Month::query()
            ->with('foods', function ($q){
                $q->whereActive();
            })
            ->when($this->search, function ($query) {
                $query->whereAny(['months.monthName',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'monthName' => 'monthName',
            default => 'monthID',
        };
    }
}
