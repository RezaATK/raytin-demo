
<!DOCTYPE html>
<html lang="fa" class="light-style customizer-hide" dir="rtl" data-theme="theme-semi-dark" data-assets-path="/assets/" data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>{{ config('app.name') }} - صفحه پیدا نشد</title>


    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}"  class="template-customizer-core-css">>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-semi-dark.css') }}"  class="template-customizer-core-css">>
    <link rel="stylesheet" href="{{ asset('assets/css/my-app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/rtl.css') }}">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css')}}">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css')}}">
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <!-- Not Authorized -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h1 class="mb-2 mx-2 secondary-font">صفحه یافت نشد :(</h1>
        <p class="mb-4 mx-2">ما قادر به یافتن صفحه‌ای که به دنبال آن بودید نشدیم</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">بازگشت به خانه</a>
        <div class="mt-5">
          <img src="{{ asset('assets/img/illustrations/page-404-error-light.png') }}" alt="page-misc-not-authorized-light" width="450" class="img-fluid" data-app-light-img="illustrations/page-404-error-light.png" data-app-dark-img="illustrations/page-404-error-dark.png">
        </div>
      </div>
    </div>
    <!-- /Not Authorized -->

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{  asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{  asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{  asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{  asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{  asset('assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{  asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{  asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{  asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
  </body>
</html>