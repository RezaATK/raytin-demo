<x-layout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper">
                <span class="text-muted fw-light">تعاونی مصرف / مدیریت فروشگاه / </span>افزودن فروشگاه
            </h4>
            <div class="row">
                <div class="col-6">
                    <div class="card"><div class="card-body">
                            <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="storeName" class="form-label">نام فروشگاه</label>
                                    <input type="text" class="form-control" value="{{ old('storeName') }}" name="storeName" >
                                    <x-show-error field="storeName"/>
                                </div>
                                <div class="mb-3">
                                    <label for="storeTerms" class="form-label">شرایط فروشگاه</label>
                                    <input type="text" class="form-control" value="{{ old('storeTerms') }}" name="storeTerms" >
                                    <x-show-error field="storeTerms"/>
                                </div>
                                <div class="mb-3">
                                    <label for="storeDetails" class="form-label">توضیحات فروشگاه</label>
                                    <input type="text" class="form-control" value="{{ old('storeDetails') }}" name="storeDetails" >
                                    <x-show-error field="storeDetails"/>
                                </div>
                                <div class="mb-3">
                                    <label for="storeAddress" class="form-label">آدرس فروشگاه</label>
                                    <input type="text" class="form-control" value="{{ old('storeAddress') }}" name="storeAddress" >
                                    <x-show-error field="storeAddress"/>
                                </div>
                                <div class="mb-3">
                                    <label for="storeNeighborhood" class="form-label">محله فروشگاه</label>
                                    <input type="text" class="form-control" value="{{ old('storeNeighborhood') }}" name="storeNeighborhood" >
                                    <x-show-error field="storeNeighborhood"/>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">عکس فروشگاه</label>
                                    <br>
                                    <label class="form-label">فرمت های مجاز : jpg - jpeg</label>
                                    <label class="form-label">و حداکثر حجم فایل : 2 مگابایت </label>
                                    <input class="form-control" name="file" type="file" id="file" accept="image/jpg, image/jpeg">
                                    <x-show-error field="file"/>
                                </div>
                                <div class="mb-3">
                                    <label for="storeCategoryID" class="form-label">دسته بندی فروشگاه</label>
                                    <select class="form-select" name ="storeCategoryID">
                                        @foreach($storeCategories as $item)
                                            <option name="storeCategoryID" value="{{ $item->storeCategoryID }}"  @selected(old('storeCategoryID') === $item->storeCategoryID)>
                                                {{ $item->categoryName }}</option>
                                        @endforeach
                                    </select>
                                    <x-show-error field="storeCategoryID"/>
                                </div>

                                <div class="mb-3 d-flex ">
                                    <div class="form-check form-switch mb-2 mt-3">
                                        <input class="form-check-input" name="isActive" type="checkbox" id="isActive" @checked(old('isActive')) dir="ltr">
                                        <label class="form-check-label" for="isActive">غیرفعال / فعال</label>
                                    </div>
                                    <x-show-error field="isActive"/>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">افزودن</button>
                                <a href="{{ route('store.manage') }}" type="button" class="btn btn-primary">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>