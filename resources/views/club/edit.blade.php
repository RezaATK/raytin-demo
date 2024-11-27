<x-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
            <span class="text-muted fw-light">خدمات ورزشی / مدیریت باشگاه / </span>افزودن باشگاه</h4>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('club.update', ['club' => $club]) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="clubName" class="form-label">نام باشکاه</label>
                                <input type="text" class="form-control"
                                       value="{{ $club->clubName }}" name="clubName">
                                <x-show-error field="clubName"/>

                            </div>
                            <div class="mb-3">
                                <label for="clubDetails" class="form-label">توضیحات باشگاه</label>
                                <input type="text" class="form-control"
                                       value="{{ $club->clubDetails }}" name="clubDetails">
                                <x-show-error field="clubDetails"/>

                            </div>
                            <div class="mb-3">
                                <label for="clubImage" class="form-label">عکس باشگاه</label>
                                <input type="text" class="form-control"
                                       value="{{ $club->clubImage }}" name="clubImage">
                                <x-show-error field="clubImage"/>

                            </div>
                            <div class="mb-3">
                                <label for="clubAddress" class="form-label">آدرس باشگاه</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $club->clubAddress }}" name="clubAddress">
                                <x-show-error field="clubAddress"/>

                            </div>
                            <div class="mb-3">
                                <label for="clubNeighborhood" class="form-label">محله باشگاه</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $club->clubNeighborhood }}"
                                       name="clubNeighborhood">
                                <x-show-error field="clubNeighborhood"/>

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
                                        <option name="clubCategoryID" value="{{ $item->clubCategoryID }}"  @selected($club->clubCategoryID === $item->clubCategoryID)>
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
</x-layout>