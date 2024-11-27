<div class="container">
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6 d-flex">
                        <div class="mx-2">
                            <a class="btn btn-primary" href="{{ route('clubcategory.create') }}">
                                <span><i class="bx bx-plus me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">
                                        ایجاد دسته بندی
                                    </span>
                                </span>
                            </a>
                        </div>
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
                monthID: false,
                monthName: true,
                foods: true,
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
                                <x-administrator.show-hide-column fieldId="monthID" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="monthName" fieldName="نام" />
                                <x-administrator.show-hide-column fieldId="foods" fieldName="غذاها" />
                                <x-administrator.show-hide-column fieldId="actions" fieldName="اقدام" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-2 d-flex justify-content-end justify-content-md-end">
                        <div class="mb-2">
                            <label for="pageSize"></label>
                            <select wire:model.live="pageSize" class="form-select" id="pageSize">
                                <option value="12">12</option>
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
                                <th wire:click="sort('id')" class="px-1" x-show="monthID" x-transition x-cloak>
                                    <x-administrator.icons-sort column="شناسه" columnEn="monthID" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('monthName')" class="px-1" x-show="monthName" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="نام" columnEn="monthName" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('foods')" class="px-1" x-show="foods" x-transition x-cloak>
                                    <x-administrator.icons-sort column="غذاها" :sortable=false />
                                </th>
                                <th class="px-3" x-show="actions" x-transition x-cloak>
                                    <x-administrator.icons-sort column="اقدام" :sortable=false />
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($months->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                                </tr>
                            @else
                                @foreach ($months as $month)
                                    <livewire:administrator.food.food-assignment.table-row :$month :key="$month->monthID"
                                        id="{{ $month->monthID }}" />
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($months))
                {{ $months->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
