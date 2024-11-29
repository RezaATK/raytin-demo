@include('letter.header')
@php
        $created_At = ((isset($lastReservData->created_at)) && (!is_null($lastReservData->created_at))) ? verta($lastReservData->created_at)->format('Y/m/d') : verta()->now()->format('Y/m/d');
        $reserved_At = ((isset($lastReservData->verified_at)) && (!is_null($lastReservData->verified_at))) ? verta($lastReservData->verified_at)->format('Y/m/d') : $created_At;
@endphp

    <script src="{{ asset('/assets/js/modern-screenshot/modern-screenshot.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('/assets/css/print.css?=v04') }}" type="text/css" media="print"/>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="top_content">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">خدمات رفاهی / درخواست های من / </span>معرفی نامه فروشگاه
            </h4>
            <div class="alert alert-primary alert-dismissible d-flex align-items-center" role="alert">
                <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-detail me-2"></i>
                    همکار ارجمند، در صورت لزوم می توانید به ارائه و یا ارسال تصویر این معرفی نامه به مدیر فروشگاه
                    اقدام نمایید. </h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="my-app-inline-spacing">
                <button type="button" class="btn btn-primary" onclick="window.print();">
                    <span class="tf-icons bx bx-printer me-1"></span>پرینت معرفی نامه
                </button>
                <button type="button" class="btn btn-primary"
                        onclick="modernScreenshot.domToPng(document.getElementById('letter_permit'), { scale:3 } ).then(dataUrl => {const link = document.createElement('a');link.download = 'Oxin_tavoni_Letter.png';link.href = dataUrl;link.click();})">
                    <span class="tf-icons bx bx-download me-1"></span>دانلود تصویر معرفی نامه
                </button>
            </div>
        </div>
        <div class="hide_in_print mb-5"></div>
        <div id="letter_permit" class="p-10 tavoni" style="
                    padding: 30px 30px 80px 30px;
                ">
            <img class="sarbarg_oxin_top" src="{{ asset('/assets/img/pages/sarbarg_tavoni_top.jpg') }}">
            <img class="sarbarg_oxin_bottom" src="{{ asset('/assets/img/pages/sarbarg_tavoni_bottom.jpg') }}">
            <div class="letter_permit_content">
                </center>

                <div style="text-align:left;">
                    <br><br><br>
                    کد درخواست : {{ $storeDiscount->trackingCode }}
                    <br>
                    تاریخ: {{ $reserved_At }}
                </div>

                <h5 class="titr"><b>مدیریت محترم فروشگاه {{ $storeDiscount->storeName }}
                        <br>
                        موضوع : معرفی نامه تعاونی مصرف
                        <br>
                    </b></h5>

                <div class="" style="text-align: justify;">
                    با سلام و احترام؛
                    <br>
                    بدینوسیله
                    آقای/خانم <b
                            class="titr">{{ $storeDiscount->UserName . ' ' . $storeDiscount->UserLastName }}</b>
                    به شماره پرسنلی <b class="titr">{{ $userData->employeeID }}</b>

                    با کد ملی
                    <b class="titr"> {{ $userData->nationalCode }} </b>
                    جهت استفاده از تسهیلات خرید
                    به حضورتان معرفی می گردد.
                    <br>
                    مستدعیست همکاری لازم را با نامرده به عمل آورید./
                </div>
                <br>
                مهلت استفاده " هفت روز کاری " پس از صدور این معرفی نامه می باشد.
                <br>
                @if (! is_null($storeDiscount->additionalNote))
                    <div>
                        <div style="margin-top: 10px;"><b> ملاحظات :</b></div>
                        <p>{{ $storeDiscount->additionalNote }}</p>
                    </div>
                @endif
                <br>

                </p>
                <div class="emza" style="line-height: 23px;">
                    با تشکر
                    <br><b>حسین ناطقی
                        <br>مدیرعامل تعاونی مصرف<br>کارکنان فولاد اکسین خوزستان</b>
                    <img src="{{ asset('/assets/img/pages/letter-emza-02.png') }}">
                </div>
                <br>

            </div>
        </div>


    </div>