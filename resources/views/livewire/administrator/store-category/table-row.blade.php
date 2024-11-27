<tr>
    <td>
        <x-administrator.checkbox :id="$storeCategory->storeCategoryID" />
    </td>
    <td x-show="storeCategoryID" x-transition x-cloak>{{ $storeCategory->storeCategoryID }}</td>
    <td x-show="categoryName" x-transition x-cloak>{{ $storeCategory->categoryName }}</td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <div class="dropdown-menu animate slideIn" style="">
                    <x-administrator.edit-button :href="route('storecategory.edit', $storeCategory->storeCategoryID)" />
                    <x-administrator.delete-button :id="$storeCategory->storeCategoryID" />
                </div>
            </div>
            <a href="{{ route('storecategory.edit', $storeCategory->storeCategoryID) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>