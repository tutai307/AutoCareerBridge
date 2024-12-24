<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Trang chủ')</title>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Job Pro"/>
    <meta name="keywords" content="Job Pro"/>
    <meta name="author" content=""/>
    <meta name="MobileOptimized" content="320"/>
    <!--srart theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/animate.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/fonts.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/reset.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/owl.carousel.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/owl.theme.default.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/flaticon.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/style_2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/responsive.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/responsive2.css')}}"/>
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @yield('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div id="preloader">
    <div id="status"><img src="{{ asset('clients/images/header/loadinganimation.gif')}}" id="preloader_image"
                          alt="loader">
    </div>
</div>

<!-- Header Wrapper Start -->
@include('client.partials.header')
@if (session()->has('status_success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session()->get('status_success') }}"
        });
    </script>
@endif

@if (session()->has('status_fail'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "error",
            title: "{!! session()->get('status_fail') !!}"
        });
    </script>
@endif

<div class="container-fluid my-3"> @yield('content')</div>

@include('client.partials.footer')

<script src="{{ asset('clients/js/jquery_min.js')}}"></script>
<script src="{{ asset('clients/js/bootstrap.js')}}"></script>
<script src="{{ asset('management-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('clients/js/jquery.menu-aim.js')}}"></script>
<script src="{{ asset('clients/js/jquery.countTo.js')}}"></script>
<script src="{{ asset('clients/js/jquery.inview.min.js')}}"></script>
<script src="{{ asset('clients/js/owl.carousel.js')}}"></script>
<script src="{{ asset('clients/js/modernizr.js')}}"></script>
<script src="{{ asset('clients/js/custom.js')}}"></script>
<script src="{{ asset('clients/js/jquery.magnific-popup.js')}}"></script>
<script src="{{ asset('clients/js/custom_II.js')}}"></script>
<script src="{{ asset('management-assets/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('management-assets/js/plugins-init/select2-init.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="{{ asset('management-assets/ckeditor/ckeditor.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('management-assets/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }}"></script>
<script src="{{ asset('management-assets/vendor/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('management-assets/js/plugins-init/select2-init.js') }}"></script>
<script src="{{ asset('clients/js/main.js') }}"></script>
@yield('js')
</body>
</html>
