@props(['method' => 'deleteItems', 'componentName' => $this->__name, 'id'])
<div x-data="deleteItems">

    <button {{ $attributes(['class' => 'dropdown-item']) }}
        @click="{{ $method }}({{ $id }})">
        <i class="bx bx-trash-alt me-1"></i>
        @if ($slot->isEmpty())
            حذف
        @else
            {{ $slot }}
        @endif
    </button>
</div>
