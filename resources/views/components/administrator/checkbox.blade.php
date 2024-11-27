@props(['fieldId' => 'checkbox', 'id'])
<div class="form-check">
    <input wire:model="$parent.ids"
            id="{{ $fieldId }}"
            {{ $attributes(['class' =>  'form-check-input my-checkbox'])  }}
            type="checkbox"
            value="{{ $id }}" >
</div>