<div class="container">
    <h4 class="breadcrumb-wrapper">
        <span class="text-muted fw-light"></span> مدیریت نقش ها
    </h4>   
    <div class="card mt-4">
        <div class="card-header heading-color flex-column">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-12 col-md-6 d-flex">
                        <div class="mx-2">
                            <a class="btn btn-primary" href="{{ route('role.create') }}">
                                <span><i class="bx bx-plus me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">
                                        ایجاد نقش
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
                id: true,
                name: true,
                permissions: true,
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
                                <x-administrator.show-hide-column fieldId="id" fieldName="شناسه" />
                                <x-administrator.show-hide-column fieldId="name" fieldName="نام" />
                                <x-administrator.show-hide-column fieldId="permissions" fieldName="مجوزها" />
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
                                <th style="width: 20px;">
                                    <x-administrator.select-all />
                                </th>
                                <th wire:click="sort('id')" class="px-1" x-show="id" x-transition x-cloak>
                                    <x-administrator.icons-sort column="شناسه" columnEn="id" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('name')" class="px-1" x-show="name" x-transition x-cloak>
                                    <x-administrator.icons-sort column="نام" columnEn="name" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th wire:click="sort('permissions')" class="px-1" x-show="permissions" x-transition
                                    x-cloak>
                                    <x-administrator.icons-sort column="مجوزها" columnEn="permissions" :$selectedColumn
                                        :$descSort />
                                </th>
                                <th class="px-3" x-show="actions" x-transition x-cloak>
                                    <x-administrator.icons-sort column="اقدام" :sortable=false />
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($roles->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">هیچ داده ای برای نمایش وجود ندارد.</td>
                                </tr>
                            @else
                                @foreach ($roles as $role)
                                    <livewire:administrator.role.table-row :$role :key="$role->id"
                                        id="{{ $role->id }}" />
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($roles))
                {{ $roles->Links('livewire.paginator') }}
            @endif
        </div>
    </div>
    <x-loading-icon />
</div>
<x-administrator.alpine />
