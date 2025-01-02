<!DOCTYPE html>
<html lang="vi">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="lang" content="{{ app()->getLocale() }}">
    <meta name="author" content="Dexignlabs">
    <meta name="robots" content="">

    <title>@yield('title', 'Trang chủ')</title>

    <!-- Favicon icon -->
    <link href="{{ asset('clients/images/header/favicon.ico') }}" rel="icon">
    <link href="{{ asset('clients/images/header/favicon.ico') }}" rel="shortcut icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet"
        href="{{ asset('management-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/wow-master/css/libs/animate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet"
        href="{{ asset('management-assets/vendor/bootstrap-select-country/css/bootstrap-select-country.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/swiper/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/select2/css/select2.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('management-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/line-awesome@1.3.0/dist/line-awesome/css/line-awesome.min.css"
        rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('management-assets/vendor/apexchart/apexchart.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('management-assets/vendor/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('toasts/jquery/1.9.1_jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('toasts/toast.css') }}">
    <script type="text/javascript" src="{{ asset('toasts/toast.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
</head>

<body>
    @if (session()->has('status_success'))
        <script>
            toastr.success("","{{ session()->get('status_success') }}")
        </script>
    @endif

    @if (session()->has('status_fail'))
        <script>
            toastr.error("","{{ session()->get('status_fail') }}")
        </script>
    @endif
    <div id="main-wrapper" class="wallet-open ">
        @include('management.partials.header')

        @include('management.partials.sidebar')
        <div class="content-body default-height" style="">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('management.partials.footer')
    </div>
    {{-- End main --}}

    {{-- script --}}
    <script src="{{ asset('management-assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- Page level css : Dashboard 2 -->
    {{-- <script src="{{ asset('management-assets/vendor/chart-js/chart.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('management-assets/vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/wow-master/dist/wow.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('management-assets/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }}">
    </script>
    <!-- Page level Js : Dashboard 2  -->
    <script src="{{ asset('management-assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('management-assets/js/dashboard/cms.js') }}"></script>
    <script src="{{ asset('management-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('management-assets/js/main.js') }}"></script>
    <script type="module" src="{{ asset('management-assets/js/realTime.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/plugins-init/toastr-init.js') }}"></script>

    {{-- <script src="{{ asset('management-assets/js/styleSwitcher.js') }}"></script> --}}


    @yield('js')

</body>

</html>
