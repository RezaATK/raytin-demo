<tr>
    <td>
        <x-administrator.checkbox :id="$role->id" />
    </td>
    <td x-show="id" x-transition x-cloak>{{ $role->id }}</td>
    <td x-show="name" x-transition x-cloak>{{ $role->name }}</td>
    <td x-show="permissions" x-transition x-cloak>
        @if($role->name !== config('auth.super_admin'))
            @foreach($role->permissions as $permission)
                <span class="badge bg-label-primary">{{ $permission->name_fa }}</span>
            @endforeach
        @else
            <span class="badge bg-label-success">تمام مجوزها</span>
        @endif
    </td>
    <td x-show="actions">
        @if($role->name !== config('auth.super_admin'))
        <div class="d-flex px-3 gap-3">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <div class="dropdown-menu animate slideIn" style="">
                    <x-administrator.edit-button :href="route('role.edit', $role->id)" />
                    <x-administrator.delete-button :id="$role->id" />
                </div>
            </div>
            <a href="{{ route('role.edit', $role->id) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
        @endif

    </td>
</tr>