<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Trang chủ')</title>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Job Pro"/>
    <meta name="keywords" content="Job Pro"/>
    <meta name="author" content=""/>
    <meta name="MobileOptimized" content="320"/>
    <!--srart theme style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/animate.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/font-awesome.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/fonts.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/reset.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/owl.carousel.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/owl.theme.default.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/flaticon.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/style.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/style_2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/responsive.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('clients/css/responsive2.css')}}"/>
    @yield('css')
    <!-- favicon links -->
    <link rel="shortcut icon" type="image/png" href="{{  asset('clients/images/header/favicon.ico')}}"/>
</head>

<body>
<!-- preloader Start -->
<div id="preloader">
    <div id="status"><img src="{{ asset('clients/images/header/loadinganimation.gif')}}" id="preloader_image"
                          alt="loader">
    </div>
</div>
<!-- Top Scroll End -->
<!-- Header Wrapper Start -->
@include('client.partials.header')
<!-- Header Wrapper End -->
<div class="container-fluid my-3"> @yield('content')</div>
<!-- jp footer Wrapper Start -->
@include('client.partials.footer')
<!-- jp footer Wrapper End -->
<!--main js file start-->
<script src="{{ asset('clients/js/jquery_min.js')}}"></script>
<script src="{{ asset('clients/js/bootstrap.js')}}"></script>
<script src="{{ asset('clients/js/jquery.menu-aim.js')}}"></script>
<script src="{{ asset('clients/js/jquery.countTo.js')}}"></script>
<script src="{{ asset('clients/js/jquery.inview.min.js')}}"></script>
<script src="{{ asset('clients/js/owl.carousel.js')}}"></script>
<script src="{{ asset('clients/js/modernizr.js')}}"></script>
<script src="{{ asset('clients/js/custom.js')}}"></script>
<script src="{{ asset('clients/js/jquery.magnific-popup.js')}}"></script>
<script src="{{ asset('clients/js/custom_II.js')}}"></script>
@yield('js')
<!--main js file end-->
</body>
</html>
