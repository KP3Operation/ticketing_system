<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">


<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>


    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../assets/img/favicon/favicon.ico') }}" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }} " />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    {{-- <link rel="stylesheet" href="assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="assets/vendor/libs/sweetalert2/sweetalert2.css" /> --}}

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.3/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/sl-2.0.4/datatables.min.css"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('styles')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    {{-- <style>
        .chevron-icon {
            cursor: pointer;
        }
    </style> --}}
    @stack('styles')
</head>


<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <x-sidebar />
            <div class="layout-page">
                <x-topbar />
                <div class="content-wrapper">
                    <div class="container-fluid w-100 flex-grow-1 container-p-y">
                        <div class="layout-demo-info">
                            <div class="layout-demo-placeholder fs-tiny">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    {{-- @yield('content') --}}
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- endbuild -->


    <!-- Vendors JS -->
    {{-- <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script> --}}

    <!-- Filepond -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <!-- Page JS -->
    @stack('scripts')


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>


</html>
