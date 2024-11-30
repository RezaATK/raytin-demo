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
            const flatpickrDateTimeSelf = document.querySelector('#flatpickr-datetime-self');
            flatpickrDateTimeSelf.flatpickr({
                enableTime: false,
                maxDate: "today",
                locale: 'fa',
                altInput: true,
                altFormat: 'Y/m/d',
                disableMobile: true
            });
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
            <span class="text-muted fw-light">مدیریت کاربران / </span>ویرایش کاربر</h4>
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', ['user' => $user]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">نام کاربر</label>
                                <input type="text" class="form-control " value="{{ $user->name }}" name="name">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="name"/>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="lastName" class="form-label">نام خانوادگی کاربر</label>
                                <input type="text" class="form-control " value="{{ $user->lastName }}" name="lastName">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="lastName"/>
                            </div>
                            <div class="mb-3">
                                <label for="mobileNumber" class="form-label">شماره موبایل</label>
                                <input type="text" class="form-control " value="{{ $user->mobileNumber }}"
                                       name="mobileNumber">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="mobileNumber"/>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">کلمه عبور</label>
                                <input type="text" class="form-control " name="password">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="password"/>
                            </div>
                            <div class="mb-3">
                                <label for="nationalCode" class="form-label">کد ملی</label>
                                <input type="text" class="form-control " value="{{ $user->nationalCode }}"
                                       name="nationalCode">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="nationalCode"/>
                            </div>
                            <div class="mb-3">
                                <label for="employeeID" class="form-label">کد پرسنلی</label>
                                <input type="text" class="form-control " value="{{ $user->employeeID }}"
                                       name="employeeID">
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="employeeID"/>
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">تاریخ تولد - نمونه تاریخ معتبر
                                    1402/11/24</label>
                                <input name="birthday" type="text" class="form-control" placeholder="انتخاب تاریخ" id="flatpickr-datetime-self" value="{{ verta($user->birthday)->formatDate()  }}">
                                <x-show-error field="birthday"/>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">جنسیت : </label>
                                @foreach($genderTypes as $item)
                                    <div class="form-check form-check-inline mt-3">
                                        <input name="gender" class="form-check-input" type="radio" value="{{ $item }}"
                                               id="{{ $item }}"
                                                @checked($user->gender === $item)>
                                        <label class="form-check-label"
                                               for="{{ $item }}">{{ $item === 'male' ? 'مذکر' : 'مونث' }}</label>
                                    </div>
                                @endforeach
                                <x-show-error field="gender"/>
                            </div>
                            <div class="mb-3">
                                <label for="unitID" class="form-label">واحد</label>
                                <select class="form-select" name="unitID">
                                    @foreach($units as $item)
                                        <option name="unitID"
                                                value="{{ $item->unitID }}" @selected($user->unitID === $item->unitID)>
                                            {{ $item->unitName }}</option>
                                    @endforeach
                                </select>
                                <x-show-error field="unitID"/>
                            </div>
                            <div class="mb-3">
                                <label for="employmentTypeID" class="form-label">نوع استخدام</label>
                                <select class="form-select" name="employmentTypeID">
                                    @foreach($employmentTypes as $item)
                                        <option name="employmentTypeID"
                                                value="{{ $item->employmentTypeID }}" @selected($user->employmentTypeID === $item->employmentTypeID) >
                                            {{ $item->employmentTypeName }}</option>
                                    @endforeach
                                </select>
                                <x-show-error field="employmentTypeID"/>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">نوع کاربر</label>
                                <input type="text" class="form-control" name="role" id="role" value="{{ $roles }}" placeholder='برای انتخاب نقش کلیک کنید'>
                                <x-show-error field="role"/>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">ویرایش</button>
                            <a href="/users/manage" type="button" class="btn btn-primary">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <h5 class="card-header heading-color">اعضای خانواده</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>نسبت</th>
                                    <th>تاریخ تولد</th>
                                    <th>کد ملی</th>
                                    <th>شماره موبایل</th>
                                    <th>اقدام</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($user->family)
                                    @foreach($user->family as $mem)
                                        @php $familyMobile = (!empty($mem->familyMemberMobileNumber)) ? $mem->familyMemberMobileNumber : ''; @endphp
                                        <tr>
                                            <td>{{ $mem->familyMemberName.' '.$mem->familyMemberLastName }}</td>
                                            <td>{{ $mem->familyMemberRelationship }}</td>
                                            <td>{{ Verta($mem->familyMemberBirthday)->format('Y/m/d') }}</td>
                                            <td>{{ $mem->familyMemberNationalCode }}</td>
                                            <td>{{ $familyMobile }}</td>
                                            <td>
                                                <form method="post"
                                                      action="{{ route('users.destroy.family', ['user' => $user]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="familyID" value="{{ $mem->familyID }}">
                                                    <button type="submit" class="btn btn-danger p-1"
                                                            name="deleteFamilyMember"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip" data-bs-title="حذف"><i
                                                                class="bx bx-x"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <form method="post" action="{{ route('users.store.family', ['user' => $user]) }}">
                            @csrf
                            <br>
                            <div class="mb-3">
                                <label for="newFamilyMemberName" class="form-label">نام فرد تحت تکفل</label>
                                <input type="text" class="form-control" value="{{ old('familyMemberName') }}"
                                       name="familyMemberName">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="familyMemberName"/>
                            </div>
                            <div class="mb-3">
                                <label for="familyMemberLastName" class="form-label">نام خانوادگی تحت تکفل</label>
                                <input type="text" class="form-control" value="{{ old('familyMemberLastName') }}"
                                       name="familyMemberLastName">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="familyMemberLastName"/>
                            </div>
                            <div class="mb-3">
                                <label for="familyMemberNationalCode" class="form-label">کد ملی تحت تکفل</label>
                                <input type="text" class="form-control" value="{{ old('familyMemberNationalCode') }}"
                                       name="familyMemberNationalCode">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="familyMemberNationalCode"/>
                            </div>
                            <div class="mb-3">
                                <label for="familyMemberMobileNumber" class="form-label">شماره موبایل تحت تکفل</label>
                                <input type="text" class="form-control" value="{{ old('familyMemberMobileNumber') }}"
                                       name="familyMemberMobileNumber">
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback"></div>
                                <x-show-error field="familyMemberMobileNumber"/>
                                <br>
                            </div>
                            <div class="mb-3">
                                <label for="flatpickr-datetime" class="form-label">تاریخ تولد - نمونه تاریخ معتبر
                                    1402/11/24</label>
                                <input name="familyMemberBirthday" type="text" class="form-control" placeholder="انتخاب تاریخ" id="flatpickr-datetime" value="{{ old('familyMemberBirthday') }}">
                                <x-show-error field="familyMemberBirthday"/>
                            </div>
                            <div class="mb-3">
                                <label for="familyMemberGender" class="form-label">جنسیت : </label>
                                @foreach($genderTypes as $item)
                                    <div class="form-check form-check-inline mt-3">
                                        <input name="familyMemberGender" class="form-check-input" type="radio"
                                               value="{{ $item }}" id="{{ $item }}"
                                                @checked($user->gender === $item)>
                                        <label class="form-check-label"
                                               for="{{ $item }}">{{ $item === 'male' ? 'مذکر' : 'مونث' }}</label>
                                    </div>
                                @endforeach
                                <x-show-error field="familyMemberGender"/>
                            </div>
                            <div class="mb-3">
                                <label for="familyMemberRelationship" class="form-label">نسبت با کارمند</label>
                                <select class="form-select" name="familyMemberRelationship">
                                    @foreach($relationshipList as $item)
                                        <option name="familyMemberRelationship" value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                <x-show-error field="employmentTypeID"/>
                            </div>
                            <button type="submit" class="btn btn-success" name="addNewFamily">افزودن</button>
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
                closeOnSelect: true
            }
        });
    </script>
</x-layout>