@props(['method', 'field', 'id'])
<label class="switch switch switch-primary px-2">
    <input type="checkbox" class="switch-input"
           wire:click="$parent.toggle('{{$method}}',{{ $id }})"
            @checked($field)
    >
    <span class="switch-toggle-slider">
                <span class="switch-on pt-1"></span>
                <span class="switch-off pt-1"></span>
          </span>
</label>