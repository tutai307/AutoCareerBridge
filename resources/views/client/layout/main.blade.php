<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Trang chủ')</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Job Pro" />
    <meta name="keywords" content="Job Pro" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--srart theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/fonts.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/reset.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/owl.carousel.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/owl.theme.default.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/flaticon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/style_2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/responsive2.css') }}" />
    <link rel="stylesheet" href="{{ asset('management-assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @yield('css')
    <link rel="shortcut icon" type="image/png" href="{{ asset('clients/images/header/favicon.ico') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="{{ asset('toasts/jquery/1.9.1_jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('toasts/toast.css') }}">
    <script type="text/javascript" src="{{ asset('toasts/toast.js') }}"></script>
</head>

<body>
    <!-- preloader Start -->
    <div id="preloader">
        <div id="status"><img src="{{ asset('clients/images/header/loadinganimation.gif') }}" id="preloader_image"
                alt="loader">
        </div>
    </div>
    <!-- Top Scroll End -->

    <!-- Header Wrapper Start -->
    @include('client.partials.header')

    @if (session()->has('status_success'))
        <script>
            toastr.success("", "{{ session()->get('status_success') }}")
        </script>
    @endif

    @if (session()->has('status_fail'))
        <script>
            toastr.error("", "{{ session()->get('status_fail') }}")
        </script>
    @endif
    <!-- Header Wrapper End -->

    <div class="container-fluid my-3">
        @yield('content')
    </div>

    <!-- jp footer Wrapper Start -->
    @include('client.partials.footer')
    <!-- jp footer Wrapper End -->

    <!--main js file start-->
    <script src="{{ asset('clients/js/jquery_min.js') }}"></script>
    <script src="{{ asset('clients/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('clients/js/jquery.menu-aim.js') }}"></script>
    <script src="{{ asset('clients/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('clients/js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('clients/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('clients/js/modernizr.js') }}"></script>
    <script src="{{ asset('clients/js/custom.js') }}"></script>
    <script src="{{ asset('clients/js/custom_II.js') }}"></script>
    <script src="{{ asset('clients/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/plugins-init/select2-init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="{{ asset('management-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- File custom.js -->
    <script src="{{ asset('clients/js/main.js') }}"></script>
    @yield('js')
</body>

</html>
