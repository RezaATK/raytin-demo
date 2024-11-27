<div class="container">
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6 d-flex">
                        <div class="mx-2">
                            <x-administrator.export-excel />
                        </div>
                        <div class="mx-2">
                            <x-administrator.delete-multiple-button />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        <form wire:submit="searchFor" class="d-flex align-items-center">
                            <div class="me-2">
                                <input type="text" wire:model="search" class="form-control" placeholder="جستجو"
                                    id="search">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-administrator.offline />
            <div class="px-1" x-data="{
                show: false,
                discountID: false,
                employeeID: true,
                UserName: true,
                UserLastName: true,
                UserNationalCode: false,
                UserMobileNumber: false,
                UserEmploymentTypeName: false,
                unitName: false,
                storeID: false,
                storeName: true,
                trackingCode: false,
                discountDate: true,
                additionalNote: true,
                letter: true,
                verification_two: true,
                actions: true
            }">
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-10">
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-secondary text-nowrap" style="max-height: fit-content;"
                                type="button" @click="show = !show">ستون های جدول
                                <i class="ms-2 bx" :class="show ? 'bx-chevron-right' : 'bx-chevron-left'"></i>
                            </button>
                            <div class="ms-2" x-show="show" x-transition>
                                <x-administrator.show-hide-column fieldId="discountID" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="employeeID" fieldName="کد پرسنلی" />
                                <x-administrator.show-hide-column fieldId="UserName" fieldName="نام کارمند" />
                                <x-administrator.show-hide-column fieldId="UserLastName"
                                    fieldName="نام و نام خانوادگی کارمند" />
                                <x-administrator.show-hide-column fieldId="UserNationalCode"
                                    fieldName="کد ملی کارمند" />
                                <x-administrator.show-hide-column fieldId="UserMobileNumber"
                                    fieldName="شماره موبایل کارمند" />
                                <x-administrator.show-hide-column fieldId="UserEmploymentTypeName"
                                    fieldName="نوع استخدام" />
                                <x-administrator.show-hide-column fieldId="unitName" fieldName="واحد" />
                                <x-administrator.show-hide-column fieldId="storeID" fieldName="شناسه فروشگاه" />
                                <x-administrator.show-hide-column fieldId="storeName" fieldName="نام فروشگاه" />
                                <x-administrator.show-hide-column fieldId="trackingCode" fieldName="کد رهگیری" />
                                <x-administrator.show-hide-column fieldId="discountDate" fieldName="برای تاریخ" />
                                <x-administrator.show-hide-column fieldId="additionalNote" fieldName="ملاحظات" />
                                <x-administrator.show-hide-column fieldId="letter" fieldName="معرفی نامه" />
                                <x-administrator.show-hide-column fieldId="verification_two" fieldName="وضعیت" />
                                <x-administrator.show-hide-column fieldId="actions" fieldName="اقدام" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-2 d-flex justify-content-end justify-content-md-end">
                        <div class="mb-2">
                            <label for="pageSize"></label>
                            <select wire:model.live="pageSize" class="form-select" id="pageSize">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-responsive-sm table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <x-administrator.select-all />
                                </th>
                                <th wire:click="sort('discountID')" class="px-1" x-show="discountID" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="شناسه" columnEn="discountID" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('employeeID')" class="px-1" x-show="employeeID" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="کد پرسنلی" columnEn="employeeID"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('UserName')" class="px-1" x-show="UserName" x-transition x-cloak>
                                    <x-administrator.icons-sort column="نام کارمند" columnEn="UserName" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('UserLastName')" class="px-1" x-show="UserLastName" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="نام و نام خانوادگی کارمند"
                                        columnEn="UserLastName" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('UserNationalCode')" class="px-1" x-show="UserNationalCode"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="کد ملی کارمند" columnEn="UserNationalCode"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('UserMobileNumber')" class="px-1" x-show="UserMobileNumber"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="شماره موبایل کارمند"
                                        columnEn="UserMobileNumber" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('UserEmploymentTypeName')" class="px-1"
                                    x-show="UserEmploymentTypeName" x-transition x-cloak>
                                    <x-administrator.icons-sort column="نوع استخدام" columnEn="UserEmploymentTypeName"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('unitName')" class="px-1" x-show="unitName" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="واحد" columnEn="unitName" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('storeID')" class="px-1" x-show="storeID" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="شناسه فروشگاه" columnEn="storeID"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('storeName')" class="px-1" x-show="storeName" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="نام فروشگاه" columnEn="storeName"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('trackingCode')" class="px-1" x-show="trackingCode"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="کد رهگیری" columnEn="trackingCode"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('discountDate')" class="px-1" x-show="discountDate"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="برای تاریخ" columnEn="discountDate"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('additionalNote')" class="px-1" x-show="additionalNote"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="ملاحظات" columnEn="additionalNote"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('letter')" class="px-1" x-show="letter" x-transition x-cloak>
                                    <x-administrator.icons-sort column="معرفی نامه" columnEn="letter" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('verification_two')" class="px-1" x-show="verification_two"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="وضعیت" columnEn="verification_two"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th class="px-3" x-show="actions" x-transition x-cloak>
                                    <x-administrator.icons-sort column="اقدام" :sortable=false />
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($discounts->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                                </tr>
                            @else
                                @foreach ($discounts as $storeDiscount)
                                    <livewire:administrator.store.verify-discounts.table-row :$storeDiscount
                                        :key="$storeDiscount->discountID" id="$storeDiscount->discountID" />
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($discounts))
                {{ $discounts->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
