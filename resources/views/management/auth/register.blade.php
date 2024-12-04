<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>{{ __('label.auth.register') }}</title>

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
                <div class="account-info-area">
                    <div class="login-content">
                        <p class="sub-title">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{ __('label.auth.page_register.title_box_left') }}</font>
                            </font>
                        </p>
                        <h1 class="title">
                            <p class="text-white">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.register') }}</font>
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
                                <font style="vertical-align: inherit;">
                                    {{ __('label.auth.page_register.title_box_right') }}</font>
                            </font>
                        </h3>
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{ __('label.auth.page_register.description_box_right') }}</font>
                            </font>
                        </p>
                    </div>
                    <h6 class="login-title"><span>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">{{ __('label.auth.register') }}</font>
                            </font>
                        </span>
                    </h6>

                    <form action="{{ route('management.postResgister') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.user_name') }}</font>
                                </font>
                            </label>
                            <input type="text" name="user_name"
                                class="form-control {{ $errors->has('user_name') ? 'is-invalid' : '' }}"
                                value="{{ old('user_name') }}">
                            @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.email') }}</font>
                                </font>
                            </label>
                            <input type="text" name="email"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                value="{{ old('email') }}">
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
                            <input type="password" id="dlab-password" name="password"
                                class="form-control dlab-password {{ $errors->has('password') ? 'is-invalid' : '' }}"
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
                                    <font style="vertical-align: inherit;">{{ __('label.auth.password_confirmation') }}
                                    </font>
                                </font>
                            </label>
                            <input type="password" id="dlab-password-2" name="password_confirmation"
                                class="form-control dlab-password {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                value="">
                            <span class="show-pass eye">
                                <i class="fa fa-eye-slash"></i>
                                <i class="fa fa-eye"></i>
                            </span>

                        </div>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="mt-4 position-relative">
                            <label class="mb-1 form-label required">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('label.auth.role') }}</font>
                                </font>
                            </label>
                            <div class="d-flex gap-3">
                                <div class="form-check custom-checkbox mb-3 checkbox-primary">
                                    <input type="radio" value="{{ ROLE_COMPANY }}"
                                        {{ old('role') == ROLE_COMPANY ? 'checked' : '' }} class="form-check-input"
                                        id="customRadioBox1" name="role">
                                    <label class="form-check-label"
                                        for="customRadioBox1">{{ __('label.auth.page_register.company') }}</label>
                                </div>
                                <div class="form-check custom-checkbox mb-3 checkbox-primary">
                                    <input type="radio" value="{{ ROLE_UNIVERSITY }}"
                                        {{ old('role') == ROLE_UNIVERSITY ? 'checked' : '' }} class="form-check-input"
                                        id="customRadioBox2" name="role">
                                    <label class="form-check-label"
                                        for="customRadioBox2">{{ __('label.auth.page_register.university') }}</label>
                                </div>
                            </div>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Đăng ký</font>
                                </font>
                            </button>
                        </div>

                        <p class="text-center">Bạn đã có tài khoản ?
                            <a class="btn-link text-primary" href="{{ route('management.login') }}">Đăng nhập</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('management-assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/custom.min.js') }}"></script>
</body>



</html>
