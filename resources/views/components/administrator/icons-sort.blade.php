@props(['column', 'columnEn', 'selectedColumn', 'descSort', 'sortable' => true])
<button @class(['btn', 'pe-none' => !$sortable])>
    @if ($sortable && $columnEn == $selectedColumn)
        <i @class([
            'bx bx-sort-up' => $descSort,
            'bx bx-sort-down' => !$descSort,
        ])></i>
    @endif
    <div @class([
        'mx-2',
        'fw-bold' => $sortable && ($columnEn == $selectedColumn),
    ])>
        {{ $column }}
    </div>
</button>
