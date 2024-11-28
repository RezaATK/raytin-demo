<x-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
            <span class="text-muted fw-light">خدمات ورزشی / مدیریت باشگاه / </span>افزودن باشگاه</h4>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('club.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="clubName" class="form-label">نام باشکاه</label>
                                <input type="text" class="form-control"
                                       value="{{ old('clubName') }}" name="clubName">
                                        <x-show-error field="clubName"/>

                            </div>
                            <div class="mb-3">
                                <label for="clubDetails" class="form-label">توضیحات باشگاه</label>
                                <input type="text" class="form-control"
                                       value="{{ old('clubDetails') }}" name="clubDetails">
                                        <x-show-error field="clubDetails"/>

                            </div>
                            <div class="mb-3">
                                <label for="clubAddress" class="form-label">آدرس باشگاه</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('clubAddress') }}" name="clubAddress">
                                <x-show-error field="clubAddress"/>
                            </div>
                            <div class="mb-3">
                                <label for="clubNeighborhood" class="form-label">محله باشگاه</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ old('clubNeighborhood') }}"
                                       name="clubNeighborhood">
                                <x-show-error field="clubNeighborhood"/>

                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">عکس باشگاه</label>
                                <br>
                                <label class="form-label">فرمت های مجاز : jpg - jpeg</label>
                                <label class="form-label">و حداکثر حجم فایل : 2 مگابایت </label>
                                <input class="form-control mb-2" name="file" type="file" id="file" accept="image/jpg, image/jpeg">
                                <x-show-error field="file"/>
                                <a href="{{ old('file') ? asset(old('file')) : asset('/uploads/no-image.jpg') }}" target=”_blank” id="image">
                                    <img src="{{ old('file') ? asset(old('file')) : asset('/uploads/no-image.jpg') }}" class="rounded" alt="عکس فروشگاه" height="100" width="100"
                                    id="img">
                                </a>
                            </div>
                            <div class="mb-3"> جنسیت:
                                <div class="form-check form-check-inline mt-3">
                                    <input name="genderSpecific" class="form-check-input" type="radio"
                                           value="آقایان" id="gender_men" checked>
                                    <label class="form-check-label" for="gender_men">آقایان</label>
                                </div>
                                <div class="form-check form-check-inline mt-3">
                                    <input name="genderSpecific" class="form-check-input" type="radio"
                                           value="بانوان" id="gender_women">
                                    <label class="form-check-label" for="gender_women">بانوان</label>
                                </div>
                                <div class="form-check form-check-inline mt-3">
                                    <input name="genderSpecific" class="form-check-input" type="radio"
                                           value="آقایان و بانوان" id="gender_men_women">
                                    <label class="form-check-label" for="gender_men_women">آقایان و
                                        بانوان</label>
                                </div>
                                <x-show-error field="genderSpecific"/>
                            </div>
                            <div class="mb-3">
                                <label for="clubCategoryID" class="form-label">دسته بندی باشگاه</label>
                                <select class="form-select" name ="clubCategoryID">
                                    @foreach($clubCategories as $item)
                                        <option name="clubCategoryID" value="{{ $item->clubCategoryID }}"  @selected(old('clubCategoryID') === $item->clubCategoryID)>
                                            {{ $item->categoryName }}</option>
                                    @endforeach
                                </select>
                                <x-show-error field="clubCategoryID"/>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">افزودن</button>
                            <a href="{{ route('club.manage') }}" type="button" class="btn btn-primary">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let img = document.querySelector('#img');
        let fileInput = document.querySelector('#file');
        fileInput.addEventListener('change', () => {
            const [file] = fileInput.files
            if (file) img.src = URL.createObjectURL(file);
        })
    </script>
</x-layout>