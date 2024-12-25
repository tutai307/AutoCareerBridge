<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>503</title>
    <link rel="stylesheet" href="{{ asset('management-assets/css/style.css') }}" class="main-css">
    <link href="{{ asset('clients/images/favicon.png') }}" rel="icon">
    <link href="{{ asset('clients/images/favicon.png') }}" rel="shortcut icon">
</head>

<body>
    <div class="fix-wrapper">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text font-weight-bold">503</h1>
                        <h4><i class="fa fa-times-circle text-danger"></i>{{ __('message.errors.503.service_unavailable') }}</h4>
                        <p>{{ __('message.errors.503.detail') }}</p>
                        <div>
                            <a class="btn btn-primary" href="javascript:window.history.back()">{{ __('message.errors.back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('management-assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('management-assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('management-assets/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('management-assets/js/demo.js') }}"></script>
    <script src="{{ asset('management-assets/js/styleSwitcher.js') }}"></script>
</body>

</html>
