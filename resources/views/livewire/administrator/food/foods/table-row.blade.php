<tr>
    <td>
        <x-administrator.checkbox :id="$food->foodID"/>
    </td>
    <td x-show="foodID" x-transition x-cloak>{{ $food->foodID }}</td>
    <td x-show="foodName" x-transition x-cloak>{{ $food->foodName }}</td>
    <td x-show="categoryName" x-transition>{{ $food->categoryName }}</td>
    <td x-show="foodPrice" x-transition x-cloak>{{ $food->foodPrice }}</td>
    <td x-show="status" x-transition x-cloak>
        <x-administrator.checkbox-table method="status" :field="$food->isActive"
                                        :id="$food->foodID"/>
    </td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <div class="dropdown-menu animate slideIn" style="">
                    <x-administrator.edit-button
                            :href="route('food.edit', $food->foodID)"/>
                    <x-administrator.delete-button :id="$food->foodID"/>
                </div>
            </div>
            <a href="{{ route('food.edit', $food->foodID) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>