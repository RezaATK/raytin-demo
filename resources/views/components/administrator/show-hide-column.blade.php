@props(['fieldId', 'fieldName'])
<a @click="{{ $fieldId }} = ! {{ $fieldId }}">
    <span :class="{{ $fieldId }} ? 'btn btn-sm btn-primary mb-2' :  'btn btn-sm btn-outline-primary mb-2'" >
        {{ $fieldName }}
    </span>
</a>