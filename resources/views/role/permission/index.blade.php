<x-layout>
    <div class="container">
            <a href="{{ route('role.permissions.create') }}" class="btn btn-success">افزودن</a>
        <div class="card mt-4">
            <table class="table table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th>
                        شناسه
                        </th>
                        <th>
                        name
                        </th>
                        <th>
                        نام مجوز
                        </th>
                        <th>
                        نام بخش
                        </th>
                        <th>
                        اقدام
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(! empty($permissions))
                        @foreach($permissions as $perm)
                            <tr>
                                <td>
                                    {{ $perm->id }}
                                </td>
                                <td>
                                    {{ $perm->name }}
                                </td>
                                <td>
                                    {{ $perm->name_fa }}
                                </td>
                                <td>
                                    {{ $perm->group_name }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-primary me-1" href="{{ route('role.permissions.edit', $perm->id) }}">ویرایش</a>
                                        <form action="{{ route('role.permissions.destroy', $perm->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (!empty($permissions))
                {{ $permissions->Links() }}
            @endif
        </div>
    </div>


</x-layout>