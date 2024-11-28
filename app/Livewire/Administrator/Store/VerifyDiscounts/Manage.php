<?php

namespace App\Livewire\Administrator\Store\VerifyDiscounts;

use App\Exports\StoresVerifyDiscountsExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\Store\StoreDiscount;
use App\Policies\Store\StoreDiscountPolicy;
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

    public string $column = 'discountID';
    public string $selectedColumn = 'discountID';
    public string $primaryKey = 'discountID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [];



    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $discounts = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($discounts->total());

        $this->currentPageIds = $discounts->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('discounts', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $discount = new StoreDiscount();
        if (! Gate::check(StoreDiscountPolicy::VerifyDiscountsDelete, $discount)) {
            $this->showOpUnauthorized();
            return;
        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $discount);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void {}


    public function export()
    {
       return (new StoresVerifyDiscountsExport())->whereIn($this->ids)->download("StoresVerifyDiscounts-" . verta()->formatDate() . ".xlsx");
    }

    #[Computed]
    protected function searchQuery(): QueryBuilder|EloquentBuilder
    {
        return StoreDiscount::query()
            ->where('store_discounts.verification_one', '=', 'verified')
            ->join('users', 'store_discounts.userID', '=', 'users.userID')
            ->join('units', 'users.unitID', '=', 'units.unitID')
            ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
            ->join('stores', 'store_discounts.storeID', '=', 'stores.storeID')
            ->select(
                'store_discounts.discountID as discountID',
                'employment_types.employmentTypeName as UserEmploymentTypeName',
                'employment_types.employmentTypeID as employmentTypeID',
                'stores.storeID as storeID',
                'stores.storeName as storeName',
                'store_discounts.trackingCode as trackingCode',
                'store_discounts.discountDate as discountDate',
                'store_discounts.additionalNote as additionalNote',
                'store_discounts.verification_two as verification_two',
                'units.unitName as unitName',
                'units.unitID as unitID',
                'users.userID as userID',
                'users.name as UserName',
                'users.employeeID as employeeID',
                'users.lastName as UserLastName',
                'users.nationalCode as UserNationalCode',
                'users.mobileNumber as UserMobileNumber',
            )
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'users.employeeID',
                    'users.name',
                    'users.lastName',
                    'users.nationalCode',
                    'users.mobileNumber',
                    'employment_types.employmentTypeName',
                    'units.unitName',
                    'store_discounts.storeName',
                    'store_discounts.trackingCode',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'discountID' => 'store_discounts.discountID',
            'employeeID' => 'users.employeeID',
            'UserName' => 'users.name',
            'UserLastName' => 'users.lastName',
            'UserNationalCode' => 'users.nationalCode',
            'UserMobileNumber' => 'users.mobileNumber',
            'UserEmploymentTypeName' => 'employment_types.employmentTypeName',
            'unitName' => 'units.unitName',
            'storeID' => 'store_discounts.storeID',
            'storeName' => 'store_discounts.storeName',
            'trackingCode' => 'store_discounts.trackingCode',
            'discountDate' => 'store_discounts.discountDate',
            'verification_two' => 'store_discounts.verification_two',
            default => 'discountID',
        };
    }

}
