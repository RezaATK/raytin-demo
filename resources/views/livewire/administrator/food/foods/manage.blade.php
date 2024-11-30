<div class="container">
    <h4 class="breadcrumb-wrapper">
        <span class="text-muted fw-light">رستوران / </span>مدیریت غذاها
    </h4>
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6 d-flex">
                        <div class="mx-2">
                            <a class="btn btn-primary" href="{{ route('food.create') }}">
                                <span><i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">ایجاد
                                        غذا</span></span>
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
                                <input type="text" wire:model.live.debounce="search" class="form-control"
                                    placeholder="جستجو" id="search">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-administrator.offline />
            <div class="px-1" x-data="{
                show: false,
                foodID: false,
                foodName: true,
                categoryName: true,
                status: true,
                actions: true
            }">
                <div class="row mt-3 mb-2">
                    <div class="col-sm-12 col-md-10 ms-1">
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-secondary text-nowrap" style="max-height: fit-content;"
                                type="button" @click="show = !show">ستون های جدول
                                <i class="ms-2 bx" :class="show ? 'bx-chevron-right' : 'bx-chevron-left'"></i>
                            </button>
                            <div class="ms-2" x-show="show" x-transition>
                                <x-administrator.show-hide-column fieldId="foodID" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="foodName" fieldName="نام" />
                                <x-administrator.show-hide-column fieldId="categoryName" fieldName="نام دسته بندی" />
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
                                <th wire:click="sort('foodID')" class="px-1" x-show="foodID" x-transition x-cloak>
                                    <x-administrator.icons-sort column="شناسه" columnEn="foodID" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('foodName')" class="px-1" x-show="foodName" x-transition x-cloak>
                                    <x-administrator.icons-sort column="نام" columnEn="foodName" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('categoryName')" class="px-1" x-show="categoryName" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="نام دسته بندی" columnEn="categoryName"
                                        :$selectedColumn :$descSort />
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

                            @if ($foods->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                                </tr>
                            @else
                                @foreach ($foods as $food)
                                    <livewire:administrator.food.foods.table-row :$food :key="$food->foodID"
                                        id="{{ $food->foodID }}" />
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($foods))
                {{ $foods->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
