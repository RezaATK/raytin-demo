<?php

namespace App\Livewire\Administrator\Club\Clubs;

use App\Exports\UsersExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\Club\Club;
use App\Policies\Club\ClubPolicy;
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

    public string $column = 'clubID';
    public string $selectedColumn = 'clubID';
    public string $primaryKey = 'clubID';

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
        $clubs = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($clubs->total());

        $this->currentPageIds = $clubs->map(fn($club) => (string) $club->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('clubs', 'categories'));
    }


    public function delete(?int $id = null): void
    {
//        Gate::authorize(ClubPolicy::DELETE, new Club());

        $club = new Club();
        if (! Gate::check(ClubPolicy::DELETE, $club)) {
            $this->showOpUnauthorized();
            return;
        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $club);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
        $club = new Club();

//        if (! Gate::check('update', $club)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        $this->handleToggle($column, $id, $club);
    }


    public function export()
    {
        return (new UsersExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery(): QueryBuilder|EloquentBuilder
    {
        return Club::query()
            ->select(
                'clubs.clubID as clubID',
                'clubs.clubName as clubName',
                'clubcategory.categoryName as categoryName',
                'clubs.clubNeighborhood as clubNeighborhood',
                'clubs.genderSpecific as genderSpecific',
                'clubs.isActive as isActive')
            ->join('clubcategory', 'clubcategory.clubCategoryID', '=', 'clubs.clubCategoryID')
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny(['clubs.clubName',
                    'clubcategory.categoryName',
                    'clubs.clubNeighborhood',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'clubName' => 'clubName',
            'categoryName' => 'categoryName',
            'clubNeighborhood' => 'clubNeighborhood',
            'genderSpecific' => 'genderSpecific',
            'status' => 'isActive',
            default => 'clubID',
        };
    }

}

