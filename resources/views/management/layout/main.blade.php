<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>@yield('title', 'Trang chủ')</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Dexignlabs">
    <meta name="robots" content="">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link href="{{ asset('/images/favicon.png') }}" type="" rel="icon">
    <link href="{{ asset('/images/favicon.png') }}" type="" rel="shortcut icon">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/wow-master/css/libs/animate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="{{ asset('management-assets/vendor/bootstrap-select-country/css/bootstrap-select-country.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/swiper/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('management-assets\vendor\apexchart\apexchart.js') }}"></script>


</head>

<body>
    @if (session()->has('status_success'))
        <script>
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "{{ session()->get('status_success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    <div id="main-wrapper" class="wallet-open ">
        @include('management.partials.header')

        @include('management.partials.navbar')
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
    <script src="{{ asset('management-assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Page level css : Dashboard 2 -->
    <script src="{{ asset('management-assets/vendor/chart-js/chart.bundle.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/wow-master/dist/wow.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }}"></script>
    <!-- Page level Js : Dashboard 2  -->
    <script src="{{ asset('management-assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('management-assets/js/dashboard/cms.js') }}"></script>
    <script src="{{ asset('management-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('management-assets/js/main.js') }}"></script>
    <script src="{{ asset('management-assets\vendor\apexchart\apexchart.js') }}"></script>

    @yield('js')

</body>

</html>
