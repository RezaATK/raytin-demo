<!DOCTYPE html>
<html
        lang="fa"
        class="light-style layout-navbar-fixed layout-menu-fixed"
        dir="rtl"
        data-theme="theme-default"
        data-assets-path="{{ asset('assets/') }}"
        data-template="vertical-menu-template-no-customizer-starter">

@include('components.administrator.partials.header')

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        @include('components.administrator.partials.menu')

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('components.administrator.partials.profile-dropdown')

            <!-- / Navbar -->


            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div>{{ $slot }}</div>

                <!-- / Content -->

            </div>

@include('components.administrator.partials.footer')

</body>
</html>



