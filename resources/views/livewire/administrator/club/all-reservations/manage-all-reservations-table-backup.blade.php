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
                reservID: true,
                employeeID: true,
                PrimaryUserFullName: true,
                primaryUserNationalCode: true,
                clubName: true,
                genderSpecific: true,
                secondaryUserRelationship: true,
                secondaryUserFullName: true,
                secondaryUserNationalCode: true,
                trackingCode: true,
                verification: true,
                letter: true,
                employmentTypeName: true,
                unitName: true,
                reservDate: true,
                actions: true
            }">
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-10">
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-secondary text-nowrap" style="max-height: fit-content;"
                                type="button" @click="show = !show">ستون های جدول
                                <i class="ms-2 bx" :class="show ? 'bx-chevron-right' : 'bx-chevron-left'"></i>
                            </button>
                            <div class="ms-2" x-show="show" x-transition>
                                <x-administrator.show-hide-column fieldId="reservID" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="employeeID" fieldName="کد پرسنلی" />
                                <x-administrator.show-hide-column fieldId="PrimaryUserFullName"
                                    fieldName="نام و نام خانوادگی کارمند" />
                                <x-administrator.show-hide-column fieldId="primaryUserNationalCode"
                                    fieldName="کد ملی کارمند" />
                                <x-administrator.show-hide-column fieldId="clubName" fieldName="باشگاه" />
                                <x-administrator.show-hide-column fieldId="genderSpecific" fieldName="ویژه" />
                                <x-administrator.show-hide-column fieldId="secondaryUserRelationship"
                                    fieldName="رزرو برای" />
                                <x-administrator.show-hide-column fieldId="secondaryUserFullName"
                                    fieldName="نام و نام خانوادگی" />
                                <x-administrator.show-hide-column fieldId="secondaryUserNationalCode"
                                    fieldName="کد ملی رزرو شده" />
                                <x-administrator.show-hide-column fieldId="trackingCode" fieldName="کد رهگیری" />
                                <x-administrator.show-hide-column fieldId="verification" fieldName="وضعیت" />
                                <x-administrator.show-hide-column fieldId="letter" fieldName="معرفی نامه" />
                                <x-administrator.show-hide-column fieldId="employmentTypeName"
                                    fieldName="نوع استخدام" />
                                <x-administrator.show-hide-column fieldId="unitName" fieldName="واحد" />
                                <x-administrator.show-hide-column fieldId="reservDate" fieldName="برای تاریخ" />
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
                                <th wire:click="sort('reservID')" class="px-1" x-show="reservID" x-transition x-cloak>
                                    <x-administrator.icons-sort column="شناسه" columnEn="reservID" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('employeeID')" class="px-1" x-show="employeeID" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="کد پرسنلی" columnEn="employeeID"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('PrimaryUserFullName')" class="px-1" x-show="PrimaryUserFullName"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="نام و نام خانوادگی کارمند"
                                        columnEn="PrimaryUserFullName" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('primaryUserNationalCode')" class="px-1"
                                    x-show="primaryUserNationalCode" x-transition x-cloak>
                                    <x-administrator.icons-sort column="کد ملی کارمند"
                                        columnEn="primaryUserNationalCode" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('clubName')" class="px-1" x-show="clubName" x-transition x-cloak>
                                    <x-administrator.icons-sort column="باشگاه" columnEn="clubName" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('genderSpecific')" class="px-1" x-show="genderSpecific"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="ویژه" columnEn="genderSpecific"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('secondaryUserRelationship')" class="px-1"
                                    x-show="secondaryUserRelationship" x-transition x-cloak>
                                    <x-administrator.icons-sort column="رزرو برای"
                                        columnEn="secondaryUserRelationship" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('secondaryUserFullName')" class="px-1"
                                    x-show="secondaryUserFullName" x-transition x-cloak>
                                    <x-administrator.icons-sort column="نام و نام خانوادگی"
                                        columnEn="secondaryUserFullName" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('secondaryUserNationalCode')" class="px-1"
                                    x-show="secondaryUserNationalCode" x-transition x-cloak>
                                    <x-administrator.icons-sort column="کد ملی رزرو شده"
                                        columnEn="secondaryUserNationalCode" :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('trackingCode')" class="px-1" x-show="trackingCode"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="کد رهگیری" columnEn="trackingCode"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('verification')" class="px-1" x-show="verification"
                                    x-transition x-cloak>
                                    <x-administrator.icons-sort column="وضعیت" columnEn="verification"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('letter')" class="px-1" x-show="letter" x-transition x-cloak>
                                    <x-administrator.icons-sort column="معرفی نامه" columnEn="letter" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('employmentTypeName')" class="px-1"
                                    x-show="employmentTypeName" x-transition x-cloak>
                                    <x-administrator.icons-sort column="نوع استخدام" columnEn="employmentTypeName"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th wire:click="sort('unitName')" class="px-1" x-show="unitName" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="واحد" columnEn="unitName" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('reservDate')" class="px-1" x-show="reservDate" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="برای تاریخ" columnEn="reservDate"
                                        :$selectedColumn :$descSort />
                                </th>
                                <th class="px-3" x-show="actions" x-transition x-cloak>
                                    <x-administrator.icons-sort column="اقدام" :sortable=false />
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($reserves->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                                </tr>
                            @else
                                @foreach ($reserves as $clubReservations)
                                    <livewire:administrator.club.manage-all-reservations-table-rows :clubReservations="$clubReservations"
                                        :key="$clubReservations->reservID" id="$clubReservations->reservID" />
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($reserves))
                {{ $reserves->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
