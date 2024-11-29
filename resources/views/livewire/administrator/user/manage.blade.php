<div class="container">
    <h4 class="breadcrumb-wrapper">
        <span class="text-muted fw-light"></span> مدیریت کاربران
    </h4>   
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row mt-3">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6 d-flex">
                        <div class="mx-2">
                            <a class="btn btn-primary" href="{{ route('users.create') }}">
                                <span><i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">ایجاد
                                        کاربر</span></span>
                            </a>
                        </div>
                        <div class="mx-2">
                            <x-administrator.export-excel />
                        </div>
                        <div class="mx-2">
                            <x-administrator.delete-multiple-button />
                        </div>
                    </div>
                    <div class="row col-md-6 d-flex justify-content-end">
                        <div class="col-sm-2 d-flex justify-content-md-end">
                                <label for="pageSize"></label>
                                <select wire:model.live="pageSize" class="form-select" id="pageSize">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <form wire:submit="searchFor">
                                    <input type="text" wire:model.live.debounce="search" class="form-control" placeholder="جستجو"
                                        id="search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-administrator.offline />
            <div class="px-1" x-data="{
            show: false,
            userID: false,
            name: true,
            lastName: true,
            mobileNumber: true,
            gender: false,
            nationalCode: true,
            employmentTypeName: false,
            unitName: true,
            status: true,
            actions: true }">
                <div class="row mt-3 mb-2">
                    <div class="col-sm-12 col-md-10 ms-1">
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-secondary text-nowrap" style="max-height: fit-content;" type="button" @click="show = !show">ستون های جدول
                                <i class="ms-2 bx" :class="show ? 'bx-chevron-right' : 'bx-chevron-left'"></i>
                            </button>
                            <div class="ms-2" x-show="show" x-transition>
                                <x-administrator.show-hide-column fieldId="userID" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="name" fieldName="نام" />
                                <x-administrator.show-hide-column fieldId="lastName" fieldName="نام خانوادگی" />
                                <x-administrator.show-hide-column fieldId="mobileNumber" fieldName="موبایل" />
                                <x-administrator.show-hide-column fieldId="gender" fieldName="جنسیت" />
                                <x-administrator.show-hide-column fieldId="nationalCode" fieldName="کدملی" />
                                <x-administrator.show-hide-column fieldId="employmentTypeName" fieldName="نوع استخدام" />
                                <x-administrator.show-hide-column fieldId="unitName" fieldName="واحد" />
                                <x-administrator.show-hide-column fieldId="status" fieldName="وضعیت" />
                                <x-administrator.show-hide-column fieldId="actions" fieldName="اقدام" />
                            </div>
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
                            <th wire:click="sort('id')" class="px-1" x-show="userID" x-transition x-cloak>
                                <x-administrator.icons-sort column="شناسه" columnEn="id" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('name')" class="px-1" x-show="name" x-transition x-cloak>
                                <x-administrator.icons-sort column="نام" columnEn="name" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('lastName')" class="px-1" x-show="lastName" x-transition x-cloak>
                                <x-administrator.icons-sort column="نام خانوادگی" columnEn="lastName" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('mobileNumber')" class="px-1" x-show="mobileNumber" x-transition x-cloak>
                                <x-administrator.icons-sort column="موبایل" columnEn="mobileNumber" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('gender')" class="px-1" x-show="gender" x-transition x-cloak>
                                <x-administrator.icons-sort column="جنسیت" columnEn="gender" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('nationalCode')" class="px-1" x-show="nationalCode" x-transition x-cloak>
                                <x-administrator.icons-sort column="کدملی" columnEn="nationalCode" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('employmentTypeName')" class="px-1" x-show="employmentTypeName" x-transition x-cloak>
                                <x-administrator.icons-sort column="نوع استخدام" columnEn="employmentTypeName" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('unitName')" class="px-1" x-show="unitName" x-transition x-cloak>
                                <x-administrator.icons-sort column="واحد" columnEn="unitName" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th wire:click="sort('status')" class="px-1" x-show="status" x-transition x-cloak>
                                <x-administrator.icons-sort column="وضعیت" columnEn="status" :$selectedColumn
                                                            :$descSort />
                            </th>
                            <th class="px-3" x-show="actions" x-transition x-cloak>
                                <x-administrator.icons-sort column="اقدام" :sortable=false />
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @if ($users->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                            <livewire:administrator.user.table-row
                                    :$user
                                    :key="$user->userID"
                                    id="{{ $user->userID }}"
                            />
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($users))
                {{ $users->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
