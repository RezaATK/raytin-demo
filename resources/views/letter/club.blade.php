@include('letter.header')


<script src="{{ asset('/assets/js/modern-screenshot/modern-screenshot.js') }}"></script>
<script src="{{ asset('/assets/js/dom-to-image/FileSaver.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('/assets/css/print.css?=v04') }}" type="text/css" media="print" />

<div class="content-wrapper">

<div class="container-xxl flex-grow-1 container-p-y">
<div class="top_content">
<h4 class="py-3 breadcrumb-wrapper mb-4">
<span class="text-muted fw-light"></span>معرفی نامه باشگاه</h4>
<div class="my-app-inline-spacing">
<button type="button" class="btn btn-primary" onclick="window.print();">
<span class="tf-icons bx bx-printer me-1"></span>پرینت معرفی نامه</button>
<button type="button" class="btn btn-primary" onclick="modernScreenshot.domToPng(document.getElementById('letter_permit'), { scale:3 } ).then(dataUrl => {const link = document.createElement('a');link.download = 'Oxin_Permit_Letter.png';link.href = dataUrl;link.click();})">
<span class="tf-icons bx bx-download me-1"></span>دانلود تصویر معرفی نامه</button>
</div>
</div>
<div class="hide_in_print mb-5"></div>
<div id="letter_permit" class="p-10">
<img class="sarbarg_oxin_top" src="{{ asset('/assets/img/pages/sarbarg_top.jpg') }}">
<img class="sarbarg_oxin_bottom" src="{{ asset('/assets/img/pages/sarbarg_bottom.jpg') }}">
<div class="letter_permit_content">
</center>

<h5 style="text-align: justify;">
<p style="text-align:left;">
کد درخواست :  {{ $clubReservations->trackingCode }}
<br>
تاریخ: {{ verta()->now()->format('Y/m/d') }}
<br><br>
<h5 class="titr"><b>مدیریت محترم باشگاه{{$clubReservations->clubName}}
<br>
موضوع : معرفی نامه ورزشی
<br>
</b></h5>

<div class="" style="text-align: justify;">
با سلام و احترام؛
<br>
بدینوسیله {{ ($clubReservations->user->gender == 'male') ? 'آقای' : 'خانم' }} آقای/خانم <b class="titr">{{$clubReservations->PrimaryUserName. ' ' .$clubReservations->PrimaryUserLastName}}</b>
به شماره پرسنلی  <b class="titr">{{$clubReservations->user->employeeID}} </b>

با کد ملی
<b class="titr">{{$clubReservations->user->nationalCode}}</b>
جهت ثبت نام در رشته
<b class="titr">{{ $clubReservations->categoryName }}</b>
@if(($clubReservations->secondayUserName != $clubReservations->PrimaryUserName) || ($clubReservations->secondayUserLastName != $clubReservations->PrimaryUserLastName))
برای
<b class="titr">{{ $clubReservations->secondayUserRelationship }}</b>
ایشان با نام
<b class="titr"> {{$clubReservations->secondayUserName . ' ' .$clubReservations->secondayUserLastName}}</b>
با کدملی
<b class="titr"> {{$clubReservations->secondayUserNationalCode}} </b>
@endif
به حضورتان معرفی می گردد.
<br>
مستدعیست همکاری لازم را با نامرده به عمل آورید./
</div>
<br>
</p>
<div class="emza" style="">
با تشکر
<br><b>رییس تربیت بدنی و تفریحات سالم
<br>محمد هاشمی زاده</b>
<img src="{{ asset('/assets/img/pages/letter-emza-01.png') }}">
</div>
<br>

<div class="end_letter">
<div class="taeed">تایید کارکرد: دوره{{verta($clubReservations->reservDate)->format('F سال Y')}}
<br><br><br>
</div>
<p>
شماره تماس تربیت بدنی و تفریحات سالم: 32909000-061   داخلی: 3535-3532
</p>
</div>

</div>
</div>
</div>

@include('letter.footer')
