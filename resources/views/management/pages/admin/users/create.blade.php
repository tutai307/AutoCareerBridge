@extends('management.layout.main')

@section('title', __('label.admin.user.create_account'))

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('label.admin.user.account') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('label.admin.user.create_account') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title">{{ __('label.admin.user.information_account') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label required">{{ __('label.admin.user.user_name') }}</label>
                                        <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                            placeholder="{{ __('label.admin.user.user_name') }}" name="user_name" value="{{ old('user_name') }}">
                                        @error('user_name')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label required">{{ __('label.admin.user.password') }}</label>
                                        <div class="input-group">
                                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                                placeholder="{{ __('label.admin.user.password') }}" name="password">
                                            <span class="input-group-text" id="toggle-password">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label required" for="password-confirm">{{ __('label.admin.user.confirm_password')}}</label>
                                        <div class="input-group">
                                            <input type="password" id="password-confirm" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="{{ __('label.admin.user.confirm_password') }}" autocomplete="new-password" name="password_confirmation">
                                            <span class="input-group-text" id="toggle-password-confirm">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">{{ __('label.admin.user.detailed_information') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="admin@gmail.com" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30 cm-content-body form excerpt">
                                    <label class="form-label required">{{  __('label.admin.user.role')}}</label>
                                    <select
                                        class="form-control default-select h-auto wide @error('role') is-invalid @enderror"
                                        name="role" placeholder="{{ __('label.admin.user.select_role') }}">
                                        <option value="{{ ROLE_SUB_ADMIN }}" {{ old('role') == ROLE_SUB_ADMIN ? 'selected' : '' }}> Sub Admin </option>
                                        <option value="{{ ROLE_UNIVERSITY }}" {{ old('role') == ROLE_UNIVERSITY ? 'selected' : '' }}>{{ __('label.admin.user.university') }}
                                        </option>
                                        <option value="{{ ROLE_COMPANY }}" {{ old('role') == ROLE_COMPANY ? 'selected' : '' }}>{{ __('label.admin.user.company') }}
                                        </option>
                                    </select>
                                    @error('role')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light">{{ __('label.admin.back')}}</a>
                            <button class="btn btn-primary" type="submit">{{  __('label.admin.add_new')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection

@section('js')
    <script>
        $('#toggle-password').on('click', function() {
            const $passwordField = $('#password');
            const $icon = $(this).find('i');
            if ($passwordField.attr('type') === 'password') {
                $passwordField.attr('type', 'text');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $passwordField.attr('type', 'password');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#toggle-password-confirm').on('click', function() {
            const $passwordConfirmField = $('#password-confirm');
            const $icon = $(this).find('i');
            if ($passwordConfirmField.attr('type') === 'password') {
                $passwordConfirmField.attr('type', 'text');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $passwordConfirmField.attr('type', 'password');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    </script>
@endsection