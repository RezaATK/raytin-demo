<?php

namespace App\Livewire\Administrator\Store\AllDiscounts;

use App\Livewire\Administrator\BaseTableRowClass;
use App\Models\Club\ClubReservations;
use App\Models\Store\StoreDiscount;
use App\Policies\Store\StoreDiscountPolicy;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class TableRow extends BaseTableRowClass
{

    public StoreDiscount $storeDiscount;

    public $listeners = [
        'updated.{storeDiscount.discountID}' => 'itemUpdated',
    ];


    public function render()
    {
        return view('livewire.' . $this->__name);
    }


    public function approve(int $id): void
    {
        $discount = new StoreDiscount();

        if (! Gate::check(StoreDiscountPolicy::AllDiscountsApprove, $discount)) {
            $this->showOpUnauthorized();
            return;
        }

        $query = $this->itemUpdated($id, true);

        $query->update([
            'verification_one' => 'verified',
            'current_verification_state' => 'waiting_two',
            'verification_two' => 'waiting',
        ]);

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->storeDiscount = $query->firstOrFail();
    }


    public function reject(int $id): void
    {
        $discount = new StoreDiscount();

        if (! Gate::check(StoreDiscountPolicy::AllDiscountsReject, $discount)) {
            $this->showOpUnauthorized();
            return;
        }

        $query = $this->itemUpdated($id, true);

        $query->update([
            'verification_one' => 'rejected',
            'current_verification_state' => 'rejected_one'
        ]);

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->storeDiscount = $query->firstOrFail();
    }


    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;

        $query = StoreDiscount::query()
            ->select(
                'store_discounts.discountID as discountID',
                'users.employeeID as employeeID',
//                DB::raw("concat(store_discounts.UserName, ' ', store_discounts.UserLastName) as PrimaryUserFullName"),
                'users.name as UserName',
                'users.lastName as UserLastName',
                'users.nationalCode as UserNationalCode',
                'users.mobileNumber as UserMobileNumber',
                'employment_types.employmentTypeName as UserEmploymentTypeName',
                'users.employmentTypeID as employmentTypeID',
                'units.unitName as unitName',
                'units.unitID as unitID',
                'store_discounts.storeID as storeID',
                'store_discounts.storeName as storeName',
                'store_discounts.trackingCode as trackingCode',
                'store_discounts.discountDate as discountDate',
                'store_discounts.verification_one as verification_one')
            ->join('users', 'store_discounts.userID', '=', 'users.userID')
            ->join('units', 'users.unitID', '=', 'units.unitID')
            ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
            ->where('discountID', $id);

            if($withReturn){
                return $query;
            }

        $this->storeDiscount = $query->first();
    }

}
