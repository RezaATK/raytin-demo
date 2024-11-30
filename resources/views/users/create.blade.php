<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    @endpush
    @push('scripts')
        <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    @endpush
    @push("footerScriptsEND")
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/jdate/jdate.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr-jdate.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/flatpickr/l10n/fa-jdate.js') }}"></script>
        <script>
            const flatpickrDateTime = document.querySelector('#flatpickr-datetime');
            flatpickrDateTime.flatpickr({
                enableTime: false,
                maxDate: "today",
                locale: 'fa',
                altInput: true,
                altFormat: 'Y/m/d',
                disableMobile: true
            });
        </script>
    @endpush
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">مدیریت کاربران / </span>افزودن کاربر</h4>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label"><span class=""></span> نام کاربر</label>
                                    <input type="text" class="form-control " value="{{ old('name') }}" name="name" >
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                    <x-show-error field="name"/>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="lastName" class="form-label">نام خانوادگی کاربر</label>
                                    <input type="text" class="form-control " value="{{ old('lastName') }}" name="lastName" >
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                    <x-show-error field="lastName"/>
                                </div>
                                <div class="mb-3">
                                    <label for="mobileNumber" class="form-label">شماره موبایل</label>
                                    <input type="text" class="form-control " value="{{ old('mobileNumber') }}" name="mobileNumber" >
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                    <x-show-error field="mobileNumber"/>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">کلمه عبور</label>
                                    <input type="text" class="form-control " name="password" >
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                    <x-show-error field="password"/>
                                </div>
                                <div class="mb-3">
                                    <label for="nationalCode" class="form-label">کد ملی</label>
                                    <input type="text" class="form-control " value="{{ old('nationalCode') }}" name="nationalCode" >
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                    <x-show-error field="nationalCode"/>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeID" class="form-label">کد پرسنلی</label>
                                    <input type="text" class="form-control " value="{{ old('employeeID') }}" name="employeeID" >
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback"></div>
                                    <x-show-error field="employeeID"/>
                                </div>
                                <div class="mb-3">
                                    <label for="birthday" class="form-label">تاریخ تولد - نمونه تاریخ معتبر
                                        1402/11/24</label>
                                    <input name="birthday" type="text" class="form-control" placeholder="انتخاب تاریخ" id="flatpickr-datetime" value="{{ verta(old('birthday'))->formatDate()  }}">
                                    <x-show-error field="birthday"/>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">جنسیت : </label>
                                    @foreach($genderTypes as $item)
                                        <div class="form-check form-check-inline mt-3">
                                            <input name="gender" class="form-check-input" type="radio" value="{{ $item }}" id="{{ $item }}"
                                                   @checked(old('gender') === $item)>
                                            <label class="form-check-label" for="{{ $item }}">{{ $item === 'male' ? 'مذکر' : 'مونث' }}</label>
                                        </div>
                                    @endforeach
                                    <x-show-error field="gender"/>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">واحد</label>
                                    <select class="form-select" name ="unitID">
                                        @foreach($units as $item)
                                            <option name="unitID" value="{{ $item->unitID }}"  @selected(old('unitID'))>
                                                {{ $item->unitName }}</option>
                                        @endforeach
                                    </select>
                                    <x-show-error field="unitID"/>
                                </div>
                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">نوع استخدام</label>
                                    <select class="form-select" name ="employmentTypeID">
                                        @foreach($employmentTypes as $item)
                                            <option name="employmentTypeID" value="{{ $item->employmentTypeID }}"  @selected(old('employmentTypeID')) >
                                                {{ $item->employmentTypeName }}</option>
                                        @endforeach
                                    </select>
                                    <x-show-error field="employmentTypeID"/>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">نوع کاربر</label>
                                    <input type="text" class="form-control" name="role" id="role" value="{{ old('roles') }}" placeholder='برای انتخاب نقش کلیک کنید'>
                                    <x-show-error field="role"/>
                                </div>

                                
                                
                                <br>
                                <button type="submit" class="btn btn-primary">افزودن</button>
                                <a href="/users/manage" type="button" class="btn btn-primary">بازگشت</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const tagsEl = document.querySelector("#role");

            const list = {!! $allRoles !!};

            let tags = new Tagify(tagsEl, {
                whitelist: list,
                enforceWhitelist: true,
                maxTags: 100,
                dropdown: {
                    maxItems: 100,
                    classname: "",
                    enabled: 0,
                    closeOnSelect: true,
                }
            });
        </script>
</x-layout>