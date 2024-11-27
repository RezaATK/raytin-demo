@props(['method' => 'approve', 'id', 'condition'])
<button class="btn btn-{{$method === 'approve' ? 'success' : 'danger'}} my-button" type="button"
        wire:click="{{$method}}({{ $id }})"
        @disabled($condition)
>
    <i wire:target="{{$method}}({{ $id }})"
       wire:loading.delay.shortest.class.remove="bx bx-{{$method === 'approve' ? 'check' : 'x'}} pe-2"
       wire:loading.delay.shortest.class.add="spinner-border spinner-border-sm me-2"
       class="bx bx-{{$method === 'approve' ? 'check' : 'x'}} pe-2"
    ></i>
    {{ $slot }}
</button>