<div class="container">
    <h4 class="breadcrumb-wrapper">
        <span class="text-muted fw-light">رستوران /</span> تخصیص غذا به ماهها
    </h4>
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6 d-flex">
                        <div class="mx-2">
                            
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
            <x-administrator.offline />
            <div class="px-1" x-data="{
                show: false,
                monthID: false,
                monthName: true,
                foods: true,
                actions: true
            }">
            <div class="row mt-3 mb-2">
                <div class="col-sm-12 col-md-10 ms-4">
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
