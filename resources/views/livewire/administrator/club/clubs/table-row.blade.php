<tr>
    <td>
        <x-administrator.checkbox :id="$club->clubID"/>
    </td>
    <td x-show="clubID" x-transition x-cloak>{{ $club->clubID }}</td>
    <td x-show="clubName" x-transition x-cloak>{{ $club->clubName }}</td>
    <td x-show="categoryName" x-transition>{{ $club->categoryName }}</td>
    <td x-show="clubNeighborhood" x-transition x-cloak>{{ $club->clubNeighborhood }}</td>
    <td x-show="genderSpecific" x-transition x-cloak>{{ $club->genderSpecific }}</td>
    <td x-show="status" x-transition x-cloak>
        <x-administrator.checkbox-table method="status" :field="$club->isActive"
                                        :id="$club->clubID"/>
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
                            :href="route('club.edit', $club->clubID)"/>
                    <x-administrator.delete-button :id="$club->clubID"/>
                </div>
            </div>
            <a href="{{ route('club.edit', $club->clubID) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>