<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Đổi mật khẩu</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Dexignlabs">
    <meta name="robots" content="">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('management-assets/css/style.css') }}">
    <link href="{{ asset('management-assets/images/favicon.png') }}" type="" rel="shortcut icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js"></script>

</head>

<body>
    @if (session()->has('status_success'))
        <script>
            Swal.fire({
                title: "{{ session()->get('status_success') }}",
                icon: "success",
                timer: 3000
            });
        </script>
    @endif

    @if (session()->has('status_fail'))
        <script>
            Swal.fire({
                title: "{{ session()->get('status_fail') }}",
                icon: "error",
                timer: 3000
            });
        </script>
    @endif
    <div class="login-account">
        <div class="row">
            <div class="col-lg-6 align-self-start">
                {{-- <div class="account-info-area" style="background-image: url(/management-assets/images/rainbow.gif)"> --}}
                <div class="account-info-area">
                    <div class="login-content">
                        <p class="sub-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Hãy đổi mật khẩu mạnh nhất để đảm bảo an toàn
                                    thông tin của bạn.</font>
                            </font>
                        </p>
                        <h1 class="title">
                            <p class="text-white">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Đổi mật khẩu</font>
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
                                <font style="vertical-align: inherit;">Đổi mật khẩu</font>
                            </font>
                        </h3>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Trang đổi mật khẩu cho phép người dùng nhập mật
                                    khẩu
                                    mới để thay đổi mật khẩu hiện tại.</font>
                            </font>
                        </p>
                    </div>
                    <h6 class="login-title"><span>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Đổi mật khẩu</font>
                            </font>
                        </span></h6>

                    <form action="{{ route('management.postPassword') }}" method="post">
                        @csrf
                        <input type="hidden" name="remember_token" value="{{ $user->remember_token }}">
                        <div class="position-relative">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Mật khẩu</font>
                                </font>
                            </label>
                            <input type="password" name="password" class="form-control dlab-password @error('password')
                                is-invalid
                            @enderror" id="dlab-password"
                                value="">
                            <span class="show-pass eye">
                                <i class="fa fa-eye-slash"></i>
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mt-4 position-relative">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Xác nhận mật khẩu</font>
                                </font>
                            </label>
                            <input type="password" name="password_confirmation" id="dlab-password"
                                class="form-control dlab-password @error('password_confirmation')
                                is-invalid
                            @enderror" value="">
                            <span class="show-pass eye">
                                <i class="fa fa-eye-slash"></i>
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Cập nhật</font>
                                </font>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('management-assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/custom.min.js') }}"></script>
</body>

</html>
