<a {{ $attributes(['href' => '#', 'class' => "dropdown-item"]) }} href="javascript:void(0);">
        <i class="bx bx-edit-alt me-1"></i>
        @if($slot->isEmpty())
                ویرایش
        @else
                {{ $slot }}
        @endif
</a>
