@props(['field', 'value'=> '', 'type' => 'text', 'fieldId'])
<label for="{{$fieldId}}" class="form-label">
    {{ $slot }}
</label>
<input type="{{ $type }}" name="{{ $field }}" id="{{ $fieldId }}" {{ $attributes(['class' => 'form-control']) }}
value="{{ $value }}">
