<tr>
    <td>
        <x-administrator.checkbox :id="$user->userID" />
    </td>
    <td x-show="userID" x-transition x-cloak>{{ $user->userID }}</td>
    <td x-show="name" x-transition x-cloak>{{ $user->name }}</td>
    <td x-show="lastName" x-transition>{{ $user->lastName }}</td>
    <td x-show="mobileNumber" x-transition x-cloak>{{ $user->mobileNumber }}</td>
    <td x-show="gender" x-transition x-cloak>{{ $user->gender }}</td>
    <td x-show="nationalCode" x-transition x-cloak>{{ $user->nationalCode }}</td>
    <td x-show="employmentTypeName" x-transition x-cloak>{{ $user->employmentTypeName }}</td>
    <td x-show="unitName" x-transition x-cloak>{{ $user->unitName }}</td>
    <td x-show="status" x-transition x-cloak>
        <x-administrator.checkbox-table method="status" :field="$user->isActive"
                                        :id="$user->userID" />
    </td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <div class="dropdown-menu animate slideIn" style="">
                    <x-administrator.edit-button :href="route('users.edit', $user->userID)" />
                    <x-administrator.delete-button :id="$user->userID" />
                </div>
            </div>
            <a href="{{ route('users.edit', $user->userID) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>