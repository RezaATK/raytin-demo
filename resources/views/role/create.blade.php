<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light"> مدیریت نقش ها /</span>افزودن
        </h4>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf

                            <div class="mb-3 mt-3">
                                <div class="card-body col-12">
                                    <label for="name" class="form-label">نام نقش</label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                                    <x-show-error field="name"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <x-show-error field="permissions"/>
                                @foreach($permissions->groupBy('section_name') as $section_name => $permission)
                                    <div class="col-12 mb-4 pb-3 border rounded">
                                        <div class="card-body d-flex">
                                            <h4 class="text-primary">{{ $section_name }}</h4>
                                            <div class="form-check ms-5 mt-2">
                                                <input class="form-check-input grandparent" type="checkbox"
                                                       name=""
                                                       value=""
                                                       id="grandparent-{{ $grandParentIndex = $loop->index }}">
                                                <label class="form-check-label" for="grandparent-{{ $loop->index }}">
                                                    انتخاب همه
                                                </label>
                                            </div>
                                        </div>
                                        @foreach($permission->groupBy('group_name') as $group_name => $perm)
                                            <div class="">
                                                <div class="card-header d-flex justify-content-between">
                                                    <h5 class=" text-info">{{ $group_name }}</h5>
                                                    <div class="form-check ms-5 mt-1">
                                                        <input class="form-check-input parent"
                                                               type="checkbox"
                                                               name=""
                                                               value=""
                                                               id="{{ (explode(':', $perm[0]->name))[0] }}">
                                                        <label class="form-check-label" for="{{ (explode(':', $perm[0]->name))[0] }}">
                                                            انتخاب همه
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    @foreach($perm as $p)
                                                    <div class="col-3 mb-3">
                                                            <div class="form-check mx-2">
                                                                <input
                                                                       class="form-check-input
                                                                        {{ (explode(':', $p->name))[0] }}
                                                                        grandparent-{{ $grandParentIndex }}
                                                                        "
                                                                       type="checkbox"
                                                                       name="permissions[]"
                                                                       value="{{ $p->name }}"
                                                                       id="label-{{ str_replace(':', '-', $p->name) }}">
                                                                <label class="form-check-label"
                                                                       for="label-{{ str_replace(':', '-', $p->name) }}">
                                                                    {{ $p->name_fa }}
                                                                </label>
                                                            </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @if(!$loop->last)
                                                <hr style="text-align: center; margin: 20px;">
                                            @endif
                                        @endforeach

                                    </div>

                                @endforeach
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">افزودن</button>
                                <a href="{{ route('role.index') }}" type="button" class="btn btn-primary">بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let allCheckboxes = document.querySelectorAll('.parent');
        allCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('click', (e) => {
                let relatedCheckboxes = document.querySelectorAll(`.${e.target.id}`);
                relatedCheckboxes.forEach(check => check.checked = !!e.target.checked)
            })
        })

        let allGrandParentCheckboxes = document.querySelectorAll('.grandparent');
        allGrandParentCheckboxes.forEach(grandparent => {
            grandparent.addEventListener('click', e => {
                let allChildCheckboxes = document.querySelectorAll(`.${e.target.id}`);
                allChildCheckboxes.forEach(child => child.checked = !!e.target.checked)
            })
        })


    </script>
</x-layout>