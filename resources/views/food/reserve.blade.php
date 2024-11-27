<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">رستوران / </span>رزرو غذا
        </h4>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="heading-color">
                            <span class="badge bg-primary fw-bolder fs-5">
                                توضیحات
                            </span>
                        </h5>
                        <p> همکار گرامی، برای مدیریت بهتر واحد آشپزخانه و کمک به پرسنل تامین، تغییراتی در چگونگی رزرو
                            رستوان انجام گرفته است:</p>

                    </div>
                    <div class="card-body my-3">
                        <p>در صورتیکه برای ماه جاری اقدام به رزرو نمایید، اگر قبل از روز 10ام ماه باشد، امکان رزرو غذا
                            برای بعد از روز 10ام را خواهید داشت.</p>
                        <p>در صورتیکه در بازه زمانی 10ام تا 20ام "ماه جاری" برای رزرو همین ماه اقدام نمایید، امکان رزرو
                            غذا برای بعد از روز 20ام را خواهید داشت.</p>
                        <p>بدیهی است علت این تغییرات، همکاری و یاری به واحد آشپزخانه برای مدیریت بهتر رستوران می
                            باشد.</p>
                        <p>به همین علت توصیه می شود رزرو هر ما را در ماه قبل انجام دهید چراکه امکان تغییر در رزرو ماه
                            آینده تا روز 20 ماه قبل برای شما فراهم می باشد
                            .</p>
                        <p>
                            همچنین حداکثر مهلت برای رزرو ماه آینده نیز تا 25 ام ماه جاری می باشد.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <h5 class="card-header heading-color"> رزرو غذای ماه جاری: <span
                                class="badge bg-info fw-bolder fs-5"><?= verta()->format('F Y') ?></span></h5>
                    <div class="card-body">
                        <form action="{{ route('food.reserve.store') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ verta()->format("n") }}" name="monthID">
                            <input type="hidden"
                                   value="{{ ($iscurrentMonthAlreadyReserved == true) ? 'true' : 'false' }}"
                                   name="isAlreadyReserved">
                            <div>
                            @if(! $iscurrentMonthAlreadyReserved)
                                @if ((empty($allowedDaysListForCurrentToReserve) || ! $allowedDaysListForCurrentToReserve))
                                    <p>مهلت رزرو ماه جاری به اتمام رسیده است</p>
                                    <button class="btn btn-primary" type="submit" name="currentMonthSubmit" disabled>ثبت رزرو</button>
                                @endif
                                @if ((!is_null($foodListForCurrentMonth) && !empty($foodListForCurrentMonth)) && !empty($allowedDaysListForCurrentToReserve))
                                    @for($i =0; $i < count($allowedDaysListForCurrentToReserve); $i++)
                                        <div class="col-md-6 mb-1">
                                            <input  size="38" class="form-control mb-1" value="{{ verta($allowedDaysListForCurrentToReserve[$i])->format('l j F Y') }}" disabled>
                                            <select class="form-select" name="data[]">
                                                <option value="{{ $allowedDaysListForCurrentToReserve[$i] . '*' . $foodListForCurrentMonth[0]->foodID . '*' . $foodListForCurrentMonth[0]->foodPrice . '*' . $foodListForCurrentMonth[0]->foodCategoryID }}" selected>
                                                    انتخاب غذا - پیشفرض : {{ $foodListForCurrentMonth[0]->foodName }}
                                                </option>
                                                @foreach ($foodListForCurrentMonth as $element) {
                                                    <option value="{{ $allowedDaysListForCurrentToReserve[$i] . '*' . $element->foodID . '*' . $element->foodPrice . '*' . $element->foodCategoryID }}">
                                                        {{ $element->foodName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                    @endfor
                                    <button class="btn btn-primary" type="submit" name="currentMonthSubmit">ثبت رزرو</button>
                                @endif
                                @if ((is_null($foodListForCurrentMonth) || empty($foodListForCurrentMonth) ) && $allowedDaysListForCurrentToReserve)
                                        @for ($i = 0; $i < count($allowedDaysListForCurrentToReserve); $i++)
                                            <div class="col-md-6 mb-1">
                                                <input size="38" class="form-control mb-1" value="{{ verta($allowedDaysListForCurrentToReserve[$i])->format('l j F Y') }}" disabled>
                                                <select class="form-select">
                                                    <option selected>به این ماه غذایی تخصیص داده نشده است.</option>
                                                </select>
                                            </div>
                                        <br>
                                        @endfor
                                        <button class="btn btn-primary" type="submit" name="currentMonthSubmit" disabled>ثبت رزرو</button>
                                @endif
                            @endif
                            @if($iscurrentMonthAlreadyReserved == true)
                                @if (!is_null($foodListForCurrentMonth))
                                    @for ($i = 0; $i < count($currentMonthReservation); $i++)
                                        <div class="col-md-6 mb-1">
                                            <input size="38" class="form-control mb-1" value="{{ verta($currentMonthReservation[$i]->reservDate)->format('l j F Y') }}" disabled>
                                            <select class="form-select" name="data[]" disabled>
                                                <option value="{{ $currentMonthReservation[$i]->reservDate . '*' . $currentMonthReservation[$i]->foodID . '*' . $currentMonthReservation[$i]->foodPrice . '*' . $currentMonthReservation[$i]->foodCategoryID }}" selected >
                                                    غذای رزرو شده : {{ $currentMonthReservation[$i]->foodName }}
                                                </option>
                                            </select>
                                        </div>
                                        <br>
                                    @endfor
                                    <button class="btn btn-primary" type="submit" name="currentMonthSubmit" disabled>ثبت رزرو</button>
                                @endif
                            @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card">
                    <h5 class="card-header heading-color"> رزرو غذای ماه بعد: <span
                                class="badge bg-warning fw-bolder fs-5">{{ verta()->startMonth()->addMonth()->format('F Y') }}</span>
                    </h5>
                    <div class="card-body">
                        <form action="{{ route('food.reserve.store') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ verta()->startMonth()->addMonth()->format("n") }}"
                                   name="monthID">
                            <input type="hidden"
                                   value="{{ ($isNextMonthAlreadyReserved === true) ? 'true' : 'false' }}"
                                   name="isAlreadyReserved">
                            <div>
                                @if ($foodListForNextMonth == null && $allowedDaysListForNextToReserve)
                                    @for($i = 0; $i < count($allowedDaysListForNextToReserve); $i++)
                                        <div class="col-md-6 mb-1">
                                            <input size="38" class="form-control mb-1" value="{{ verta($allowedDaysListForNextToReserve[$i])->format('l j F Y') }}" disabled>
                                            <select class="form-select">
                                                <option selected>به این ماه غذایی تخصیص داده نشده است.</option>
                                            </select>
                                        </div>
                                        <br>
                                    @endfor
                                        <button class="btn btn-primary" type="submit" name="nextMonthSubmit" disabled>ثبت رزرو</button>
                                @endif
                                @if ($isNextMonthAlreadyReserved == false && $canChangeNextMonth == true && $foodListForNextMonth != null)
                                      @for ($i = 0; $i < count($allowedDaysListForNextToReserve); $i++)
                                            <div class="col-md-6 mb-1">
                                                <input size="38" class="form-control mb-1" value="{{ verta($allowedDaysListForNextToReserve[$i])->format('l j F Y') }}" disabled>
                                                <select class="form-select" name="data[]">
                                                    <option value="{{ $allowedDaysListForNextToReserve[$i] . '*' . $foodListForNextMonth[0]->foodID }}" selected >انتخاب غذا - پیشفرض :
                                                        {{ $foodListForNextMonth[0]->foodName }}
                                                    </option>
                                            @foreach ($foodListForNextMonth as $element)
                                                    <option value="{{ $allowedDaysListForNextToReserve[$i] . '*' . $element->foodID }}">{{ $element->foodName }}</option>
                                            @endforeach
                                                </select>
                                            </div>
                                            <br>
                                      @endfor
                                          <button class="btn btn-primary" type="submit" name="nextMonthSubmit">ثبت رزرو</button>
                                @endif
                                @if ($isNextMonthAlreadyReserved == true && $canChangeNextMonth == true && $foodListForNextMonth != null)
                                    @for ($i = 0; $i < count($nextMonthReservation); $i++)
                                            <div class="col-md-6 mb-1">
                                                <input size="38" class="form-control mb-1" value="{{ verta($nextMonthReservation[$i]->reservDate)->format('l j F Y') }}" disabled>
                                                <select class="form-select" name="data[]">
                                                    <option value="{{ $nextMonthReservation[$i]->reservDate . '*' . $nextMonthReservation[$i]->foodID }}" selected >غذای رزرو شده :
                                                        {{ $nextMonthReservation[$i]->foodName }}
                                                    </option>
                                                @foreach($foodListForNextMonth as $element)
                                                        <option value="{{ $nextMonthReservation[$i]->reservDate . '*' . $element->foodID }}">{{ $element->foodName }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <br>
                                    @endfor
                                        <button class="btn btn-primary" type="submit" name="nextMonthSubmit">ثبت رزرو</button>
                                @endif
                                @if ($isNextMonthAlreadyReserved == true && $canChangeNextMonth == false && $foodListForNextMonth != null)
                                    @if (!is_null($foodListForNextMonth))
                                        @for ($i = 0; $i < count($allowedDaysList); $i++)
                                                <div class="col-md-6 mb-1">
                                                    <input size="38" class="form-control mb-1" value="{{ verta($nextMonthReservation[$i]->reservDate)->format('l j F Y') }}" disabled>
                                                    <select class="form-select" name="data[]" disabled>
                                                        <option value="{{ $nextMonthReservation[$i]->reservDate . '*' . $nextMonthReservation[$i]->foodID }}" selected >غذای رزرو شده :
                                                            {{ $nextMonthReservation[$i]->foodName }}</option>
                                                    </select>
                                                </div>
                                                <br>
                                        @endfor
                                            <button class="btn btn-primary" type="submit" name="nextMonthSubmit" disabled>ثبت رزرو</button>
                                    @endif
                                @endif
                                @if ($isNextMonthAlreadyReserved == false && $canChangeNextMonth == false && $foodListForNextMonth != null)
                                    <p>مهلت رزرو ماه آینده به اتمام رسیده است</p>
                                    <button class="btn btn-primary" type="submit" name="nextMonthSubmit" disabled>ثبت رزرو</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layout>