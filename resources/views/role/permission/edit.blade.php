<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">مدیریت نقش ها / مدیریت دسترسی ها / </span>ویرایش
        </h4>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('role.permissions.update', $permission) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">نام دسترسی به انگلیسی (نمونه: news:create)</label>
                                <input type="text" class="form-control" value="{{ $permission->name }}" name="name" >
                                <x-show-error field="name"/>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="name_fa" class="form-label">نام دسترسی به فارسی (نمونه: ایجاد خبر جدید)</label>
                                <input type="text" class="form-control" value="{{ $permission->name_fa }}" name="name_fa" >
                                <x-show-error field="name_fa"/>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="group_name" class="form-label">گروه بندی دسترسی به فارسی (نمونه: بخش اخبار)</label>
                                <input type="text" class="form-control" value="{{ $permission->group_name }}" name="group_name" >
                                <x-show-error field="group_name"/>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="section_name" class="form-label">بخش کلی مرتبط با دسترسی به فارسی (نمونه: بخش خدمات ورزشی)</label>
                                <input type="text" class="form-control" value="{{ $permission->section_name }}" name="section_name" >
                                <x-show-error field="section_name"/>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">ویرایش</button>
                                <a href="{{ route('role.permissions.index') }}" type="button" class="btn btn-primary">بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>