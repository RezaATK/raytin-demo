<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
            <span class="text-muted fw-light"></span>پروفایل من
        </h4>
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">نام و نام خانوادگی کاربر</label>
                <input type="text" class="form-control"
                    value="{{ $user->name . ' ' . $user->lastName }}"
                    id="name"
                    name="name" disabled>

                <label for="employeeID" class="form-label">شماره پرسنلی</label>
                <input type="text" class="form-control" 
                    value="{{ $user->employeeID }}" 
                    id="employeeID"
                    name="employeeID" disabled>

                <label for="mobileNumber" class="form-label">شماره موبایل</label>
                <input type="text" class="form-control" 
                    value="{{ $user->mobileNumber }}"
                    id="mobileNumber" name="mobileNumber" disabled>

                <label for="nationalCode" class="form-label">کد ملی</label>
                <input type="text" class="form-control" 
                    value="{{ $user->nationalCode }}"
                    id="nationalCode" name="nationalCode" disabled>

                <label for="birthday" class="form-label">تاریخ تولد</label>
                <input type="text" class="form-control"
                    value="{{ verta($user->birthday)->format('Y/m/d') }}" id="birthday" 
                    name="birthday" disabled>


            </div>
            <div class="col-md-6 mb-3">
                <form action="{{ route('profile.update') }}" method="POST">
                    @method('patch')
                    @csrf
                    <label for="current_password" class="form-label">کلمه عبور قبلی</label>
                    <input type="password" class="form-control"
                        name="current_password">
                        <x-show-error field="current_password"/>

                    <label for="password" class="form-label mt-3">کلمه عبور جدید</label>
                    <input type="password" class="form-control"
                        name="password">
                        <x-show-error field="password"/>

                    <label for="password_confirmation" class="form-label mt-3">تکرار کلمه عبور</label>
                    <input type="password" class="form-control"
                        name="password_confirmation">
                        <x-show-error field="password_confirmation"/>

                    <button type="submit" class="btn btn-primary mt-3" name="">بروزرسانی کلمه
                        عبور</button>
                    <a href="{{ route('dashboard') }}" type="button" class="btn btn-primary mt-3">بازگشت</a>
                </form>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <h5 class="card-header heading-color">افراد تحت تکفل شما</h5>
                    <center>
                        <p>در صورت مشاهده مغایرت در اطلاعات به مدیریت سامانه اطلاع دهید</p>
                    </center>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>نسبت با کارمند</th>
                                    <th>کد ملی</th>
                                    <th>شماره موبایل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->family)
                                    @foreach($user->family as $familyMember)
                                            <tr>
                                                <td>{{ $familyMember->familyMemberName }}</td>
                                                <td>{{ $familyMember->familyMemberLastName }}</td>
                                                <td>{{ $familyMember->familyMemberRelationship }}</td>
                                                <td>{{ $familyMember->familyMemberNationalCode }}</td>
                                                <td>{{ $familyMember->familyMemberMobileNumber }}</td>
                                            </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td>بدون داده</td>
                                    <td>بدون داده</td>
                                    <td>بدون داده</td>
                                    <td>بدون داده</td>
                                    <td>بدون داده</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
