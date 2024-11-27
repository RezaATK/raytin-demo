@props(['field', 'status'])
<label for="{{$field}}" class="form-label">
    {{ $slot }}
    <label {{ $attributes(['class' => 'switch switch-lg switch-success']) }}">
        <input id="{{$field}}" type="checkbox" class="switch-input" name="{{$field}}"
               @checked($status)>
        <span class="switch-toggle-slider">
            <span class="switch-on pt-1"></span>
            <span class="switch-off pt-1"></span>
        </span>
    </label>
</label>
