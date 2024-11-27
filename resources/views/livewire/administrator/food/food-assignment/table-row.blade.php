<tr>
    <td x-show="monthID" x-transition x-cloak>{{ $month->monthID }}</td>
    <td x-show="monthName" x-transition x-cloak>{{ $month->monthName }}</td>
    <td x-show="monthName" x-transition x-cloak>
        @foreach($month->foods as $food)
            <span class="badge bg-label-success">{{ $food->foodName }}</span>
        @endforeach
    </td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <a href="{{ route('foodassignment.edit', $month->monthID) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>