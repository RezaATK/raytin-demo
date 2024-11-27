@props(['field', 'loopData' => [], 'id', 'fieldId'])
<label for="{{$fieldId}}" class="form-label">
    {{ $slot }}
</label>
<select name="{{$field}}" id="{{$fieldId}}"
        class="select2 form-select form-select-lg select2-hidden-accessible"
        data-allow-clear="true" tabindex="-1" aria-hidden="true">
    @if($loopData)
        @foreach($loopData as $item)
            <option value={{ $item->id }}
                    @selected($item->id == $id)>
                {{ $item->name }}
            </option>
        @endforeach
    @endif
</select>
