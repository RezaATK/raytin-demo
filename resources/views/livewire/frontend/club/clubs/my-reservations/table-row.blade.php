<tr>
    <td x-show="id" x-transition x-cloak>{{ $reserve->id }}</td>
    <td x-show="clubName" x-transition x-cloak>{{ $reserve->clubName }}</td>
    <td x-show="fullName" x-transition x-cloak>{{ $reserve->fullName }}</td>
    <td x-show="relation" x-transition x-cloak>{{ $reserve->relation }}</td>
    <td x-show="date" x-transition x-cloak>{{ verta($reserve->date)->format('F Y') }}</td>
    <td x-show="verification" x-transition x-cloak>
        @if ($reserve->verification == 'pending')
            <span class="badge rounded-pill bg-label-secondary">در انتظار تایید</span>
        @elseif($reserve->verification == 'verified')
            <span class="badge rounded-pill bg-label-success">تایید شده</span>
        @elseif($reserve->verification == 'rejected')
            <span class="badge rounded-pill bg-label-danger">رد شده</span>
        @else
            <span class="badge rounded-pill bg-label-danger">بدون داده</span>
        @endif
    </td>
    <td x-show="letter" x-cloak>
        <div class="d-flex px-3 gap-3">
            @if ($reserve->verification == 'verified')
                <a type="button" class="btn btn-primary" href="/clubs/letter/{{ $reserve->trackingCode }}" >مشاهده معرفی نامه</a>
            @else
                بدون داده
            @endif
        </div>
    </td>
</tr>