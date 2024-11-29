<?php

namespace App\Livewire\Administrator\Store\VerifyDiscounts;

use App\Livewire\Administrator\BaseTableRowClass;
use App\Models\Club\ClubReservations;
use App\Models\Store\StoreDiscount;
use App\Policies\Store\StoreDiscountPolicy;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TableRow extends BaseTableRowClass
{

    public StoreDiscount $storeDiscount;

    #[Validate('required|max:255', as: 'ملاحظات')]
    public $additionalNote = '';

    public From $form;

    public $listeners = [
        'updated.{storeDiscount.discountID}' => '$refresh',
    ];

    public function mount()
    {
        $this->additionalNote = $this->storeDiscount->additionalNote;
    }

    public function render()
    {
        return view('livewire.' . $this->__name);
    }


    public function save($id)
    {
        $discount = new StoreDiscount();
        if (! Gate::check(StoreDiscountPolicy::VerifyDiscountsAdditionalNote, $discount)) {
            $this->showOpUnauthorized();
            return;
        }

        $query = StoreDiscount::query()->where('discountID', $id)->firstOrFail();

        if(filled($this->additionalNote) && mb_strlen($this->additionalNote) < 255) {
            $query->update([
                    'additionalNote' => $this->additionalNote,
            ]);
            session()->flash('success', 'پیام شما با موفقیت ثبت شد.');
        }

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->storeDiscount = $query;


    }


    public function approve(int $id): void
    {
        $discount = new StoreDiscount();
        if (! Gate::check(StoreDiscountPolicy::VerifyDiscountsApprove, $discount)) {
            $this->showOpUnauthorized();
            return;
        }
        $query = $this->itemUpdated($id, true)->firstOrFail();

        $query->update([
            'verification_two' => 'verified',
            'current_verification_state' => 'verified_two',
        ]);

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->storeDiscount = $query;
    }


    public function reject(int $id): void
    {
        $discount = new StoreDiscount();
        if (! Gate::check(StoreDiscountPolicy::VerifyDiscountsReject, $discount)) {
            $this->showOpUnauthorized();
            return;
        }
        $query = $this->itemUpdated($id, true);
        $query->update([
            'verification_two' => 'rejected',
            'current_verification_state' => 'rejected_two'
        ]);

        $this->dispatch("updated.{$id}", ['id' => $id])->self();

        $this->storeDiscount = $query->firstOrFail();
    }


    public function itemUpdated($data, $withReturn = false)
    {
        $id = is_array($data) ? $data['id'] : $data;

        $query = StoreDiscount::query()
            ->where('store_discounts.discountID', $id)
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
            );

            if($withReturn){
                return $query;
            }

        $this->storeDiscount = $query->first();
    }

}
