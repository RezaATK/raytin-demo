<?php

namespace App\Livewire\Frontend\Store\Stores\MyDiscounts;

use App\Livewire\Frontend\TableSimpleBaseClass;
use App\Models\Store\StoreDiscount;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;

#[Lazy]
class Table extends TableSimpleBaseClass
{
    use withPagination;

    public string $column = 'discountID';
    public string $selectedColumn = 'id';
    protected string $primaryKey = 'discountID';

    public array $currentPageIds = [];



    public function render(): View
    {
        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $mydiscounts = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($mydiscounts->total());

        $this->currentPageIds = $mydiscounts->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('mydiscounts'));
    }


    protected function export()
    {
//        return (new ClubCategorysExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery()
    {
        return StoreDiscount::query()
            ->where('userID', auth()->user()->userID)
            ->selectRaw("store_discounts.discountID as id,
                            store_discounts.storeName as storeName,
                            concat(store_discounts.UserName, ' ', store_discounts.UserLastName) as fullName,
                            store_discounts.UserNationalCode as nationalCode,
                            store_discounts.discountDate as date,
                            store_discounts.verification_one as verification_one,
                            store_discounts.verification_two as verification_two,
                            store_discounts.trackingCode as trackingCode")
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'store_discounts.storeName',
                    'store_discounts.UserName',
                    'store_discounts.UserLastName',
                    'UserNationalCode',
                ], 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'storeName' => 'store_discounts.storeName',
            'fullName' => 'store_discounts.UserLastName',
            'nationalCode' => 'store_discounts.UserNationalCode',
            'date' => 'store_discounts.discountDate',
            default => 'store_discounts.discountID',
        };
    }
}
