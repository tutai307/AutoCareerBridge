@extends('home.layouts.app')
@section('title', 'Đăng nhập')
@section('content')
    <div class="container-xxl bg-white p-0">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp" alt="login form"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="{{ route('home.login') }}" method="post">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="{{ asset('storage/home/logo.png') }}" alt="" style="width: 100px; height: 100px;">
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập với tài khoản sinh viên
                                        </h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Mã sinh viên <span class="text-danger">*</span></label>
                                            <input type="text" id="form2Example17" name="student_code"
                                                class="form-control form-control-lg" />
                                                @error('student_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Mật khẩu <span class="text-danger">*</span></label>
                                            <input type="password" id="form2Example27" name="password"
                                                class="form-control form-control-lg" />
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button type="submit" style="background-color: #00b074; color: white" data-mdb-button-init
                                                data-mdb-ripple-init class="btn btn-lg btn-block" type="button">Đăng nhập</button>
                                            <a href="{{ route('home.forgot-password') }}" class="small text-muted float-end mt-2" href="#!">Quên mật khẩu?</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@php
    $hideFooter = true;
@endphp
