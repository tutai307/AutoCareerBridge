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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <!-- favicon links -->
    <link rel="shortcut icon" type="image/png" href="{{  asset('clients/images/header/favicon.ico')}}"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
<!-- Header Wrapper End -->
<div class="container-fluid my-3"> @yield('content')</div>
<!-- jp footer Wrapper Start -->
@include('client.partials.footer')
<!-- jp footer Wrapper End -->
<!--main js file start-->

<script src="{{ asset('clients/js/jquery_min.js')}}"></script>
<script src="{{ asset('clients/js/bootstrap.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    // ckediter
    CKEDITOR.config.versionCheck = false;
    CKEDITOR.config.allowedContent = true;

    $(document).ready(function () {
        $(".tinymce_editor_init").each(function () {
            var textareaID = $(this).attr("id");
            CKEDITOR.replace(textareaID, {
                // removePlugins: 'elementspath,save',
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },  // Chỉ hiển thị một số nút cơ bản
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList'] }
                ]
            });


        });

        function addImageCaption(img) {
            var altText = $(img).attr('alt');
            if (altText) {
                var caption = $('<div>', {
                    'class': 'image-caption',
                    'text': altText,
                    'css': {
                        'text-align': 'center',
                        'font-style': 'italic'
                    }
                });
                $(img).after(caption);
            }
        }

        CKEDITOR.on('instanceReady', function (evt) {
            var editor = evt.editor;
            $(document).on("click", ".cke_dialog_ui_button_ok", function () {
                setTimeout(function () {
                    var images = $(editor.document.$).find('img');
                    images.each(function () {
                        if (!$(this).next().hasClass('image-caption')) {
                            addImageCaption(this);
                        }
                    });
                }, 100);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

</script>
@yield('js')
<!--main js file end-->
</body>
</html>
