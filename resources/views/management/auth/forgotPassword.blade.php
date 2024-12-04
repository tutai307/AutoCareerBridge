<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>{{ __('label.auth.forgot_password') }}</title>

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

</head>

<body>
    <div class="login-account">
        <div class="row">
            <div class="col-lg-6 align-self-start">
                {{-- <div class="account-info-area" style="background-image: url(/managemnt-assets/images/rainbow.gif)"> --}}
                <div class="account-info-area">
                    <div class="login-content">
                        <h1 class="">
                            <p class="text-white">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.page_forgot_password.title_box_left') }}</font>
                                </font>
                            </p>
                        </h1>
                        <p class="sub-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.page_forgot_password.description_box_left') }}</font>
                            </font>
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
                <div class="login-form">
                    <div class="login-head">
                        <h3 class="title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.forgot_password') }}</font>
                            </font>
                        </h3>
                        <h2>Không sao cả!</h2>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.page_forgot_password.description_box_right') }}</font>
                            </font>
                        </p>
                    </div>
                    <h6 class="login-title"><span>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.forgot_password') }}</font>
                            </font>
                        </span>
                    </h6>

                    <form action="{{ route('management.checkForgotPassword') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.email') }}</font>
                                </font>
                            </label>
                            <input type="text" name="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                value="">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.page_forgot_password.send') }}</font>
                                </font>
                            </button>
                        </div>

                        <p class="text-center">{{ __('label.auth.page_forgot_password.have_acount') }}
                            <a class="btn-link text-primary" href="{{ route('management.login') }}">{{ __('label.auth.login') }}</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
