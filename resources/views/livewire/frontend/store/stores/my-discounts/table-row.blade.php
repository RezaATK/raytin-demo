<tr>
    <td x-show="id" x-transition x-cloak>{{ $discount->id }}</td>
    <td x-show="storeName" x-transition x-cloak>{{ $discount->storeName }}</td>
    <td x-show="fullName" x-transition x-cloak>{{ $discount->fullName }}</td>
    <td x-show="nationalCode" x-transition x-cloak>{{ $discount->nationalCode }}</td>
    <td x-show="date" x-transition x-cloak>{{ verta($discount->date)->format('F Y') }}</td>
    <td x-show="verification" x-transition x-cloak>
        @if ($discount->verification_one == 'rejected' || $discount->verification_two == 'rejected')
            <span class="badge rounded-pill bg-label-danger">رد شده</span>
        @elseif ($discount->verification_two == 'verified')
            <span class="badge rounded-pill bg-label-success">تایید شده</span>
        @else
            <span class="badge rounded-pill bg-label-secondary">در انتظار تایید</span>
        @endif
    </td>
    <td x-show="letter" x-cloak>
        <div class="d-flex px-3 gap-3">
            @if ($discount->verification_two == 'verified')
                <a type="button" class="btn btn-primary" href=/stores/letter/{{ $discount->trackingCode }} >مشاهده معرفی نامه</a>
            @else
                بدون داده
            @endif
        </div>
    </td>
</tr>