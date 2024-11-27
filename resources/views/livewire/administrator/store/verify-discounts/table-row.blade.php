<tr>
    <td>
        <x-administrator.checkbox :id="$storeDiscount->discountID" />
    </td>
    <td x-show="discountID" x-transition x-cloak>{{ $storeDiscount->discountID }}</td>
    <td x-show="employeeID" x-transition x-cloak>{{ $storeDiscount->employeeID ?? $storeDiscount->user->employeeID }}
    </td>
    <td x-show="UserName" x-transition>{{ $storeDiscount->UserName ?? $storeDiscount->user->name }}</td>
    <td x-show="UserLastName" x-transition x-cloak>{{ $storeDiscount->UserLastName ?? $storeDiscount->user->lastName }}</td>
    <td x-show="UserNationalCode" x-transition x-cloak>{{ $storeDiscount->UserNationalCode ?? $storeDiscount->user->nationalCode }}</td>
    <td x-show="UserMobileNumber" x-transition x-cloak>{{ $storeDiscount->UserMobileNumber ?? $storeDiscount->user->mobileNumber }}</td>
    <td x-show="UserEmploymentTypeName" x-transition x-cloak>{{ $storeDiscount->UserEmploymentTypeName ?? $storeDiscount->user->employmentType->employmentTypeName }}</td>
    <td x-show="unitName" x-transition x-cloak>{{ $storeDiscount->unitName ?? $storeDiscount->user->unit->unitName}}</td>
    <td x-show="storeID" x-transition x-cloak>{{ $storeDiscount->storeID ?? $storeDiscount->store->storeID }}</td>
    <td x-show="storeName" x-transition x-cloak>{{ $storeDiscount->storeName ?? $storeDiscount->store->storeName }}</td>
    <td x-show="trackingCode" x-transition x-cloak>{{ $storeDiscount->trackingCode }}</td>
    <td x-show="discountDate" x-transition x-cloak>
        {{ verta($storeDiscount->discountDate)->format('F Y') }}
    </td>
    <td x-show="additionalNote" x-transition x-cloak>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal{{ $storeDiscount->discountID }}">
            ملاحظات
        </button>
        <div  wire:ignore.self class="modal fade" id="largeModal{{ $storeDiscount->discountID }}" tabindex="-1" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">ملاحظلات</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent>
                        <div class="modal-body">
                            <p>در صورت تمایل می توانید توضیحات اضافه ای را در این قسمت وارد نمایید تا در معرفی نامه کارمند درج گردد</p>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="additionalNote" class="form-label">توضیحات تکمیلی</label>
                                    <textarea  wire:model="additionalNote" name="additionalNote" id="additionalNote"
                                      class="form-control" rows="4"
                                      @disabled($storeDiscount->verification_two == 'verified' || $storeDiscount->verification_two == 'rejected')
                                    >{{ $storeDiscount->additionalNote }}</textarea>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between pb-2">
                                <div class="d-flex justify-content-between">
                                    <p class="text-danger">
                                        @error('additionalNote')
                                        {{ $message }}
                                        @enderror
                                    </p>
                                    <p class="text-success">
                                        @if(session('success'))
                                            {{ session('success') }}
                                        @endif
                                    </p>
                                </div>

                                <div class="gap-3">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                            wire:click="save({{ $storeDiscount->discountID }})"
                                    @disabled($storeDiscount->verification_two == 'verified' || $storeDiscount->verification_two == 'rejected')
                                    >ثبت
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </td>
    <td x-show="letter" x-transition x-cloak>
        @if ($storeDiscount->verification_two == 'verified')
            <a type="button" class="btn btn-primary" href="{{ route('store.letter', ['storeDiscount' => $storeDiscount->trackingCode ]) }}" target="_blank">مشاهده معرفی نامه</a>
        @else
            بدون داده
        @endif
    </td>
    <td x-show="verification_two" x-transition x-cloak>
        @if ($storeDiscount->verification_two == 'waiting')
            <span class="badge rounded-pill bg-label-secondary">در انتظار تایید</span>
        @elseif($storeDiscount->verification_two == 'verified')
            <span class="badge rounded-pill bg-label-success">تایید شده</span>
        @elseif($storeDiscount->verification_two == 'rejected')
            <span class="badge rounded-pill bg-label-danger">رد شده</span>
        @else
            <span class="badge rounded-pill bg-label-danger">بدون داده</span>
        @endif
    </td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <x-administrator.some-custom-button method="approve" :id="$storeDiscount->discountID"
                                                :condition="$storeDiscount->verification_two !== 'waiting'" >
                تایید
            </x-administrator.some-custom-button>

            <x-administrator.some-custom-button method="reject" :id="$storeDiscount->discountID"
                                                :condition="$storeDiscount->verification_two !== 'waiting'" >
                رد
            </x-administrator.some-custom-button>
            <button x-data="deleteItems" @click="deleteItems({{$storeDiscount->discountID}})"
                    class="btn btn-warning my-button"
                    @disabled($storeDiscount->verification_two === 'waiting')
            >
                <i class='bx bx-x pe-2'></i>
                حذف
            </button>
        </div>
    </td>
</tr>
