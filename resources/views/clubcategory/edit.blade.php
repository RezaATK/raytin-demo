<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">خدمات ورزشی / دسته بندی باشگاه ها / </span>ویرایش
        </h4>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('clubcategory.update', ['clubCategory' => $clubCategory]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3 mt-3">
                                <label for="categoryName" class="form-label">نام دسته بندی جدید برای لیست باشگاه ها</label>
                                <input type="text" class="form-control" value="{{ $clubCategory->categoryName }}" name="categoryName" >
                                <x-show-error field="categoryName"/>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">ویرایش</button>
                                <a href="{{ route('clubcategory.index') }}" type="button" class="btn btn-primary">بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>