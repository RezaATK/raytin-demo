<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{config('app.name')}}</title>

    <meta name="description" content="" />
    <meta name="csrf_token" content="{{ csrf_token() }}">



    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />


    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" /> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css">
   <link rel="stylesheet" href="{{ asset('assets/css/my-app.css?=v04') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/rtl.css') }}" />


    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />


    <link rel="stylesheet" href="{{ asset('assets/js/sweetalert2/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />


{{--    <link rel="stylesheet" href="{{ asset('assets/js/filepond/filepond.min.css') }}" />--}}
{{--    <link href="{{ asset('assets/js/filepond/filepond-plugin-image-preview.css') }}" rel="stylesheet"/>--}}
{{--    <link href="{{ asset('assets/js/filepond/filepond-plugin-file-poster.css') }}" rel="stylesheet"/>--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />--}}


{{--    @livewireStyles--}}

    @stack("styles")

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>


    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>

    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>


{{--    <script src="{{ asset('assets/js/filepond/filepond.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/filepond/filepond-plugin-image-preview.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/filepond/filepond-plugin-file-poster.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/filepond/filepond-plugin-file-validate-size.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/filepond/filepond-plugin-file-validate-type.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/js/filepond/filepond_fa_locale.js') }}"></script>--}}

{{--    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>--}}


{{--    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/vendor/libs/sortablejs/sortable.js') }}"></script>--}}

    <script src="{{ asset('assets/js/custom/script.js') }}"></script>


    @stack('scripts')

    <style>

        [x-cloak] {
            display: none !important
        }
        /* start of pretty dropdown effect */
        @media (min-width: 992px) {
            .animate {
                animation-duration: 0.3s;
                -webkit-animation-duration: 0.3s;
                animation-fill-mode: both;
                -webkit-animation-fill-mode: both;
            }
        }
        @keyframes slideIn {
            0% {
                transform: translateY(1rem);
                opacity: 0;
            }
            100% {
                transform:translateY(0rem);
                opacity: 1;
            }
            0% {
                transform: translateY(1rem);
                opacity: 0;
            }
        }

        @-webkit-keyframes slideIn {
            0% {
                -webkit-transform: transform;
                -webkit-opacity: 0;
            }
            100% {
                -webkit-transform: translateY(0);
                -webkit-opacity: 1;
            }
            0% {
                -webkit-transform: translateY(1rem);
                -webkit-opacity: 0;
            }
        }
        .slideIn {
            -webkit-animation-name: slideIn;
            animation-name: slideIn;
        }
        /* end of pretty dropdown effect */




        /* tinymce small fix (on page load, for a seconds it shows a textarea box then shows the actual tinymce element) */
        .textarea{
            visibility: hidden;
        }


        /* filepond tweaks */
        .filepond--file-status-sub{
            direction: rtl;
        }
        .filepond--credits {
            display: none;
        }
        /* three column structure for filepond element that has .filepond-container class on it */
        .filepond-container .filepond--item {
            width: calc(33.3% - 0.5em);
        }



        /* fix toast message showing under profile menu (menu bar) */
        .swal2-container {
            padding-top: 120px;
            padding-left: 40px;
        }




        .my-button {
            
        }

        /* Custom CSS */
        .my-transition {
            transition: ease-out 100ms;
        }

        .my-hidden {
            opacity: 0;
            transform: scale(0.9);
        }

        .full-opacity {
            opacity: 1;
        }





    </style>



</head>
