<div class="container">
    <h4 class="breadcrumb-wrapper">
        <span class="text-muted fw-light">خدمات رفاهی /</span> درخواست های من
    </h4>
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row d-flex align-items-between mt-3">
                <div class="col-sm-12 col-md-6 d-flex">
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
            <x-administrator.offline />
            <div class="px-1" x-data="{
            show: false,
            id: false,
            storeName: true,
            fullName: true,
            nationalCode: true,
            date: true,
            verification: true,
            letter: true }">
                <div class="row mt-2">
                    <div class="col-sm-12 col-md-10">
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-secondary text-nowrap" style="max-height: fit-content;" type="button" @click="show = !show">ستون های جدول
                                <i class="ms-2 bx" :class="show ? 'bx-chevron-right' : 'bx-chevron-left'"></i>
                            </button>
                            <div class="ms-2" x-show="show" x-transition>
                                <x-administrator.show-hide-column fieldId="id" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="storeName" fieldName="نام باشگاه" />
                                <x-administrator.show-hide-column fieldId="fullName" fieldName="نام و نام خانوادگی" />
                                <x-administrator.show-hide-column fieldId="nationalCode" fieldName="کد ملی" />
                                <x-administrator.show-hide-column fieldId="date" fieldName="درخواست برای" />
                                <x-administrator.show-hide-column fieldId="letter" fieldName="معرفی نامه" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-2 d-flex justify-content-center justify-content-md-end">
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
                            <th wire:click="sort('id')" class="px-1" x-show="id" x-transition x-cloak>
                                <x-administrator.icons-sort column="شناسه" columnEn="id" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('storeName')" class="px-1" x-show="storeName" x-transition x-cloak>
                                <x-administrator.icons-sort column="نام باشگاه" columnEn="storeName" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('fullName')" class="px-1" x-show="fullName" x-transition x-cloak>
                                <x-administrator.icons-sort column="نام و نام خانوادگی" columnEn="fullName" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('nationalCode')" class="px-1" x-show="nationalCode" x-transition x-cloak>
                                <x-administrator.icons-sort column="کد ملی" columnEn="nationalCode" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('date')" class="px-1" x-show="date" x-transition x-cloak>
                                <x-administrator.icons-sort column="درخواست برای" columnEn="date" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('verification')" class="px-1" x-show="verification" x-transition x-cloak>
                                <x-administrator.icons-sort column="وضعیت" columnEn="verification" :$selectedColumn
                                                            :$descSort  :sortable=false />
                            </th>
                            <th class="px-3" x-show="letter" x-transition x-cloak>
                                <x-administrator.icons-sort column="معرفی نامه" :sortable=false />
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @if ($mydiscounts->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                            </tr>
                        @else
                            @foreach ($mydiscounts as $discount)
                                <livewire:frontend.store.stores.my-discounts.table-row
                                        :$discount
                                        :key="$discount->id"
                                        id="{{ $discount->id }}"
                                />
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($mydiscounts))
                {{ $mydiscounts->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
