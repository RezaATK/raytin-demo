<tr>
    <td>
        <x-administrator.checkbox :id="$clubReservations->reservID" />
    </td>
    <td x-show="reservID" x-transition x-cloak>{{ $clubReservations->reservID }}</td>
    <td x-show="employeeID" x-transition x-cloak>{{ $clubReservations->employeeID }}</td>
    <td x-show="PrimaryUserFullName" x-transition>{{ $clubReservations->name . ' ' . $clubReservations->lastName }}</td>
    <td x-show="primaryUserNationalCode" x-transition x-cloak>{{ $clubReservations->nationalCode }}</td>
    <td x-show="clubName" x-transition x-cloak>{{ $clubReservations->clubName }}</td>
    <td x-show="genderSpecific" x-transition x-cloak>{{ $clubReservations->genderSpecific }}</td>
    <td x-show="secondaryUserRelationship" x-transition x-cloak>{{ $clubReservations->secondayUserRelationship }}</td>
    <td x-show="secondaryUserFullName" x-transition x-cloak>{{ $clubReservations->secondayUserName . ' ' . $clubReservations->secondayUserLastName }}</td>
    <td x-show="secondayUserNationalCode" x-transition x-cloak>{{ $clubReservations->secondayUserNationalCode }}</td>
    <td x-show="trackingCode" x-transition x-cloak>
        {{ $clubReservations->trackingCode }}
    </td>
    <td x-show="verification" x-transition x-cloak>
        @if ($clubReservations->verification == 'pending')
            <span class="badge rounded-pill bg-label-secondary">در انتظار تایید</span>
        @elseif($clubReservations->verification == 'verified')
            <span class="badge rounded-pill bg-label-success">تایید شده</span>
        @elseif($clubReservations->verification == 'rejected')
            <span class="badge rounded-pill bg-label-danger">رد شده</span>
        @else
            <span class="badge rounded-pill bg-label-danger">بدون داده</span>
        @endif
    </td>
    <td x-show="letter" x-transition x-cloak>
        @if ($clubReservations->verification == 'verified')
            <a type="button" class="btn btn-primary" href="{{ route('club.letter', ['clubReservations' => $clubReservations->trackingCode ]) }}" target="_blank">مشاهده معرفی نامه</a>
        @else
            بدون داده
        @endif
    </td>
    <td x-show="employmentTypeName" x-transition x-cloak>{{ $clubReservations->employmentTypeName }}</td>
    <td x-show="unitName" x-transition x-cloak>{{ $clubReservations->unitName }}</td>
    <td x-show="reservDate" x-transition x-cloak>
        {{ verta($clubReservations->reservDate)->format('F Y') }}
    </td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <x-administrator.some-custom-button method="approve" :id="$clubReservations->reservID"
                                                :condition="$clubReservations->verification !== 'pending'" >
                تایید
            </x-administrator.some-custom-button>

            <x-administrator.some-custom-button method="reject" :id="$clubReservations->reservID"
                                                :condition="$clubReservations->verification !== 'pending'" >
                رد
            </x-administrator.some-custom-button>
            <button x-data="deleteItems" @click="deleteItems({{$clubReservations->reservID}})"
                    class="btn btn-warning my-button"
                    @disabled($clubReservations->verification === 'pending')
            >
                <i class='bx bx-x pe-2'></i>
                حذف
            </button>
        </div>
    </td>
</tr>