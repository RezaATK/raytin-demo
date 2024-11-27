<?php

namespace App\Livewire\Administrator\ClubCategory;

use App\Livewire\Administrator\BaseTableClass;
use App\Models\Club\ClubCategory;
use App\Policies\Club\ClubPolicy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'clubCategoryID';
    public string $selectedColumn = 'clubCategoryID';
    public string $primaryKey = 'clubCategoryID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [];



    public function render(): View
    {
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $clubCategories = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($clubCategories->total());

        $this->currentPageIds = $clubCategories->map(fn($cat) => (string) $cat->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('clubCategories', 'categories'));
    }


    public function delete(?int $id = null): void
    {
//        Gate::authorize(ClubPolicy::DELETE, new ClubCategory());
        $clubCategory = new ClubCategory();
        if (! Gate::check(ClubPolicy::DELETE, $clubCategory)) {
            $this->showOpUnauthorized();
            return;
        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $clubCategory);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
//        $clubCategory = new ClubCategory();

//        if (! Gate::check('update', $clubCategory)) {
//            $this->showOpUnauthorized();
//            return;
//        }

//        $this->handleToggle($column, $id, $clubCategory);
    }


    public function export()
    {
//        return (new ClubCategorysExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery()
    {
        return ClubCategory::query()
            ->select('clubCategoryID','categoryName')
            ->when($this->search, function ($query) {
                $query->where('categoryName', 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'categoryName' => 'categoryName',
            default => 'clubCategoryID',
        };
    }


}
