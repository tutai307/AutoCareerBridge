<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>{{ __('label.auth.login') }}</title>

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
                <div class="account-info-area">
                    <div class="login-content">
                        <p class="sub-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.page_login.title_box_left') }}
                                </font>
                            </font>
                        </p>
                        <h1 class="title">
                            <p class="text-white">
                                <font style="vertical-align: inherit;">

                                    <font style="vertical-align: inherit;">{{ __('label.auth.login') }}</font>
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
                                <font style="vertical-align: inherit;">{{ __('label.auth.page_login.title_box_right') }}
                                </font>
                            </font>
                        </h3>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{ __('label.auth.page_login.description_box_right') }}</font>
                            </font>
                        </p>
                    </div>
                    <h6 class="login-title"><span>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.login') }}</font>
                            </font>
                        </span></h6>

                    <form action="{{ route('management.checkLogin') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">

                                    <font style="vertical-align: inherit;">
                                        {{ __('label.auth.page_login.email_or_username') }}</font>
                                </font>
                            </label>
                            <input type="text" name="email" class="form-control" value="">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="position-relative">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.password') }}</font>
                                </font>
                            </label>
                            <input type="password" name="password" id="dlab-password" class="form-control"
                                value="">
                            <span class="show-pass eye">
                                <i class="fa fa-eye-slash"></i>
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if (Session::has('error'))
                            <span class="text-danger">{{ Session::get('error') }}</span>
                        @endif

                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                            <div class="mb-4">
                                <div class="form-check custom-checkbox mb-3">
                                    <input type="checkbox" class="form-check-input" id="customCheckBox1">

                                    <label class="form-check-label"
                                        for="customCheckBox1">{{ __('label.auth.page_login.remember_me') }}</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <a href="{{ route('management.forgotPassword') }}"
                                    class="btn-link text-primary">{{ __('label.auth.page_login.forgot_password') }}</a>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.login') }}</font>
                                </font>
                            </button>
                        </div>


                        <p class="text-center">{{ __('label.auth.page_login.dont_have_account') }}
                            <a class="btn-link text-primary"
                                href="{{ route('management.register') }}">{{ __('label.auth.register') }}</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('management-assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/custom.min.js') }}"></script>

</body>



</html>
