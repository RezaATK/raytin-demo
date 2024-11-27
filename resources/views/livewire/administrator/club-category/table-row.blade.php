<tr>
    <td>
        <x-administrator.checkbox :id="$clubCategory->clubCategoryID" />
    </td>
    <td x-show="clubCategoryID" x-transition x-cloak>{{ $clubCategory->clubCategoryID }}</td>
    <td x-show="categoryName" x-transition x-cloak>{{ $clubCategory->categoryName }}</td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <div class="dropdown-menu animate slideIn" style="">
                    <x-administrator.edit-button :href="route('clubcategory.edit', $clubCategory->clubCategoryID)" />
                    <x-administrator.delete-button :id="$clubCategory->clubCategoryID" />
                </div>
            </div>
            <a href="{{ route('clubcategory.edit', $clubCategory->clubCategoryID) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>