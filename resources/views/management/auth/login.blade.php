<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Đăng nhập</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Dexignlabs">
    <meta name="robots" content="">


    <meta name="twitter:card" content="summary_large_image">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <link href="{{ asset('admin-assets/images/favicon.png') }}" type="" rel="shortcut icon">

</head>

<body>
    <div class="login-account">
        <div class="row">
            <div class="col-lg-6 align-self-start">
                <div class="account-info-area" style="background-image: url(/admin-assets/images/rainbow.gif)">
                    <div class="login-content">
                        <p class="sub-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Đăng nhập vào bảng điều khiển quản trị của bạn
                                    bằng thông tin đăng nhập của bạn</font>
                            </font>
                        </p>
                        <h1 class="title">
                            <p class="text-white">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Admin</font>
                                </font>
                            </p>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
                <div class="login-form">
                    <div class="login-head">
                        <h3 class="title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Chào mừng trở lại</font>
                            </font>
                        </h3>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Trang đăng nhập cho phép người dùng nhập thông
                                    tin đăng nhập để xác thực và truy cập vào nội dung an toàn.</font>
                            </font>
                        </p>
                    </div>
                    <h6 class="login-title"><span>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Đăng nhập</font>
                            </font>
                        </span></h6>

                    <form action="{{ route('admin.login.check') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">E-mail</font>
                                </font>
                            </label>
                            <input type="email" name="email" class="form-control" value="">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4 position-relative">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Mật khẩu</font>
                                </font>
                            </label>
                            <input type="password" name="password" id="dlab-password" class="form-control"
                                value="">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            @if (Session::has('error'))
                                <span class="text-danger">{{ Session::get('error') }}</span>
                            @endif
                        </div>
                       
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Đăng nhập</font>
                                </font>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>



</html>
