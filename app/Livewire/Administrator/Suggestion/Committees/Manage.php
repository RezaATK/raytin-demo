<?php

namespace App\Livewire\Administrator\Suggestion\Committees;

use App\Livewire\Administrator\BaseTableClass;
use App\Models\Suggestion\SuggestionsCommittee;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy]
class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'id';
    public string $selectedColumn = 'id';
    public string $primaryKey = 'id';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [];



    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $committees = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($committees->total());

        $this->currentPageIds = $committees->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('committees', 'categories'));
    }


    public function delete(?int $id = null): void
    {
//        $discount = new SuggestionsCommittee();
//        if (! Gate::check(StoreDiscountPolicy::AllDiscountsDelete, $discount)) {
//            $this->showOpUnauthorized();
//            return;
//        }

//        $ids = $this->resolveIds($id);
//
//        $this->handleDelete($ids, $discount);

    }


    public function export()
    {
//        return (new UsersExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery()
    {
        return SuggestionsCommittee::query()
            ->select(
                'suggestions_committees.id as id',
                'suggestions_committees.name as name',
                'users.employeeID as employeeID',
                DB::raw("concat(users.name, ' ', users.lastName) as fullName"))
            ->join('users', 'suggestions_committees.userID', '=', 'users.userID')
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'suggestions_committees.id',
                    'suggestions_committees.name',
                    'users.employeeID',
                    'lastName',
                    'fullName',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'suggestions_committees.id' => 'suggestions_committees.id',
            'fullName' => 'fullName',
            'users.employeeID' => 'users.employeeID',
            'lastName' => 'title',
            default => 'id',
        };
    }


    public function toggle(string $column, int $id): void {}
}
