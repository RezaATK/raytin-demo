<tr>
    <td>
        <x-administrator.checkbox :id="$storeDiscount->discountID" />
    </td>
    <td x-show="discountID" x-transition x-cloak>{{ $storeDiscount->discountID }}</td>
    <td x-show="employeeID" x-transition x-cloak>{{ $storeDiscount->employeeID }}</td>
    <td x-show="UserName" x-transition>{{ $storeDiscount->UserName }}</td>
    <td x-show="UserLastName" x-transition x-cloak>{{ $storeDiscount->UserLastName }}</td>
    <td x-show="UserNationalCode" x-transition x-cloak>{{ $storeDiscount->UserNationalCode }}</td>
    <td x-show="UserMobileNumber" x-transition x-cloak>{{ $storeDiscount->UserMobileNumber }}</td>
    <td x-show="UserEmploymentTypeName" x-transition x-cloak>{{ $storeDiscount->UserEmploymentTypeName }}</td>
    <td x-show="unitName" x-transition x-cloak>{{ $storeDiscount->unitName }}</td>
    <td x-show="storeID" x-transition x-cloak>{{ $storeDiscount->storeID }}</td>
    <td x-show="storeName" x-transition x-cloak>{{ $storeDiscount->storeName }}</td>
    <td x-show="trackingCode" x-transition x-cloak>{{ $storeDiscount->trackingCode }}</td>
    <td x-show="discountDate" x-transition x-cloak>
        {{ verta($storeDiscount->discountDate)->format('F Y') }}
    </td>
    <td x-show="verification_one" x-transition x-cloak>
        @if ($storeDiscount->verification_one == 'waiting')
            <span class="badge rounded-pill bg-label-secondary">در انتظار تایید</span>
        @elseif($storeDiscount->verification_one == 'verified')
            <span class="badge rounded-pill bg-label-success">تایید شده</span>
        @elseif($storeDiscount->verification_one == 'rejected')
            <span class="badge rounded-pill bg-label-danger">رد شده</span>
        @else
            <span class="badge rounded-pill bg-label-danger">بدون داده</span>
        @endif
    </td>

    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <x-administrator.some-custom-button method="approve" :id="$storeDiscount->discountID"
                                                :condition="$storeDiscount->verification_one !== 'waiting'" >
                تایید
            </x-administrator.some-custom-button>

            <x-administrator.some-custom-button method="reject" :id="$storeDiscount->discountID"
                                                :condition="$storeDiscount->verification_one !== 'waiting'" >
                رد
            </x-administrator.some-custom-button>
            <button x-data="deleteItems" @click="deleteItems({{$storeDiscount->discountID}})"
                    class="btn btn-warning my-button"
                    @disabled($storeDiscount->verification_one === 'waiting')
            >
                <i class='bx bx-x pe-2'></i>
                حذف
            </button>
        </div>
    </td>
</tr>
