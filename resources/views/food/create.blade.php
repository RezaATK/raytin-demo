<x-layout>
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper">
                <span class="text-muted fw-light">رستوران / مدیریت غذاها / </span>افزودن غذا
            </h4>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('food.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="foodName" class="form-label">نام غذا</label>
                                    <input type="text" name="foodName" value="{{ old('foodName') }}" class="form-control" id="foodName">
                                    <x-show-error field="foodName" />
                                </div>

                                <div class="mb-3">
                                    <label for="foodDetails" class="form-label">توضیحات غذا</label>
                                    <input type="text" name="foodDetails" value="{{ old('foodDetails') }}" class="form-control" id="foodDetails">
                                    <x-show-error field="foodDetails" />
                                </div>

                                <div class="mb-3">
                                    <label for="commaSeperated" class="form-label">هزینه یک پرس از غذا</label>
                                    <input type="text" name="foodPrice" value="{{ old('foodPrice') }}" class="form-control" id="commaSeperated">
                                    <div id="floatingInputHelp" class="form-text">به تومان - جهت محاسبه هزینه ها</div>
                                    <x-show-error field="foodPrice" />
                                </div>
                                <div class="mb-3">
                                    <label for="foodCategoryID" class="form-label">دسته بندی غذا</label>
                                    <select class="form-select" name ="foodCategoryID">
                                        @foreach($categories as $item)
                                            <option name="foodCategoryID" value="{{ $item->foodCategoryID }}"
                                                    @selected(old('foodCategoryID') === $item->foodCategoryID)>
                                                {{ $item->categoryName }}</option>
                                        @endforeach
                                    </select>
                                    <x-show-error field="foodCategoryID"/>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">افزودن</button>
                                <a href="{{ route('food.manage') }}" type="button" class="btn btn-primary">بازگشت</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        let cost = document.querySelector('#commaSeperated');
        cost.addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/[^0-9.]/g, '');
            value = e.target.value;

            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            if (value) {
                const formattedValue = formatNumberWithCommas(value);
                e.target.value = formattedValue;
            }
        });
        
        </script>
</x-layout>