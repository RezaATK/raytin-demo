<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
            <span class="text-muted fw-light">تعاونی مصرف / مدیریت فروشگاه / </span>افزودن فروشگاه
        </h4>
        <div class="row">
            <div class="col-6">
                <div class="card"><div class="card-body">
                        <form action="{{ route('store.update', ['store' => $store]) }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('put')
                            <div class="mb-3 mt-3">
                                <label for="storeName" class="form-label">نام فروشگاه</label>
                                <input type="text" class="form-control" value="{{ $store->storeName }}" name="storeName" >
                                <x-show-error field="storeName"/>
                            </div>
                            <div class="mb-3">
                                <label for="storeTerms" class="form-label">شرایط فروشگاه</label>
                                <input type="text" class="form-control" value="{{ $store->storeTerms }}" name="storeTerms" >
                                <x-show-error field="storeTerms"/>
                            </div>
                            <div class="mb-3">
                                <label for="storeDetails" class="form-label">توضیحات فروشگاه</label>
                                <input type="text" class="form-control" value="{{ $store->storeDetails }}" name="storeDetails" >
                                <x-show-error field="storeDetails"/>
                            </div>
                            <div class="mb-3">
                                <label for="storeAddress" class="form-label">آدرس فروشگاه</label>
                                <input type="text" class="form-control" value="{{ $store->storeAddress }}" name="storeAddress" >
                                <x-show-error field="storeAddress"/>
                            </div>
                            <div class="mb-3">
                                <label for="storeNeighborhood" class="form-label">محله فروشگاه</label>
                                <input type="text" class="form-control" value="{{ $store->storeNeighborhood }}" name="storeNeighborhood" >
                                <x-show-error field="storeNeighborhood"/>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">عکس فروشگاه</label>
                                <br>
                                <label class="form-label">فرمت های مجاز : jpg - jpeg</label>
                                <label class="form-label">و حداکثر حجم فایل : 2 مگابایت </label>
                                <input class="form-control" name="file" type="file" id="file" accept="image/jpg, image/jpeg">
                                <x-show-error field="file"/>

                                <a href="{{ $store->storeImage ? asset($store->storeImage) : asset('/uploads/stores/no-image.jpg') }}" target=”_blank” id="image">
                                    <img src="{{ $store->storeImage ? asset($store->storeImage) : asset('/uploads/stores/no-image.jpg') }}" class="rounded" alt="عکس فروشگاه" height="100" width="100"
                                    id="img">
                                </a>
                                @if($store->storeImage)
                                    <button id="deleteImage" class="btn btn-sm btn-danger mx-4">
                                        حذف تصویر
                                    </button>
                                    <div id="deleteSuccess" class="text-success"></div>
                                    <div id="deleteFailed" class="text-danger"></div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="storeCategoryID" class="form-label">دسته بندی فروشگاه</label>
                                <select class="form-select" name ="storeCategoryID">
                                    @foreach($storeCategories as $item)
                                        <option name="storeCategoryID" value="{{ $item->storeCategoryID }}"  @selected($store->storeCategoryID === $item->storeCategoryID)>
                                            {{ $item->categoryName }}</option>
                                    @endforeach
                                </select>
                                <x-show-error field="storeCategoryID"/>
                            </div>

                            <div class="mb-3 d-flex ">
                                <div class="form-check form-switch mb-2 mt-3">
                                    <input class="form-check-input" name="isActive" type="checkbox" id="isActive" @checked($store->isActive) dir="ltr">
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


    <script>

        let deleteImage = document.querySelector('#deleteImage');
        deleteImage.addEventListener('click', (e) => {
            e.preventDefault();
            fetch("{{ route('store.deleteImage', ['store' => $store]) }}", {
                method: "post",
                headers: {
                 "accept": "application/json",
                 "X-CSRF-Token" : "{{ csrf_token() }}"
                }
            }).then(res => {
                if (!res.ok) {
                    throw new Error('fatal Error')
                }
                return res.json()
            })
                .then(data => {
                    if(data.message === "success"){
                        document.querySelector('#image').setAttribute('href', '/uploads/stores/no-image.jpg');
                        document.querySelector('#img').setAttribute('src', '/uploads/stores/no-image.jpg');
                        document.querySelector('#img').setAttribute('src', '/uploads/stores/no-image.jpg');
                        document.querySelector('#deleteSuccess').innerHTML = 'تصویر با موفقیت حذف شد'
                        document.querySelector('#deleteImage').remove();
                        setTimeout(() => {
                            document.querySelector('#deleteSuccess').innerHTML = ""
                        }, 4000);
                    }else{
                        document.querySelector('#deleteFailed').innerHTML = 'خظا در حذف تصویر'
                        setTimeout(() => {
                            document.querySelector('#deleteFailed').innerHTML = ""
                        }, 4000);
                    }
                })
                .catch(err => console.log(err))
        })
    </script>
</x-layout>