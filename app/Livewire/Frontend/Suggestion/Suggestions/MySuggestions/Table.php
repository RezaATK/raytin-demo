<?php

namespace App\Livewire\Frontend\Suggestion\Suggestions\MySuggestions;

use App\Livewire\Frontend\TableSimpleBaseClass;
use App\Models\Suggestion\Suggestion;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;


#[Lazy]
class Table extends TableSimpleBaseClass
{
    use withPagination;

    public string $column = 'id';
    public string $selectedColumn = 'id';
    protected string $primaryKey = 'id';

    public array $currentPageIds = [];



    public function render(): View
    {
        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $mysuggestions = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($mysuggestions->total());

        $this->currentPageIds = $mysuggestions->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('mysuggestions'));
    }


    protected function export()
    {
//        return (new ClubCategorysExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery()
    {
        return Suggestion::query()
            ->with('user')
            ->where('userID', auth()->user()->userID)
            ->select('id',
                            'userID',
                            'title',
                            'status',
                            'uniqueID as urlID')
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'title',
                ], 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'title' => 'status',
            'status' => 'title',
            default => 'id',
        };
    }
}

