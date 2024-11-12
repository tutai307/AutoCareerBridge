@extends('management.layout.main')

@section('title', 'Thêm mới tài khoản')

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
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Tài khoản</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thêm mới tài khoản</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title">Thông tin tài khoản</h6>
                            </div>
                            <div class="card-footer">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">Tên đăng nhập <span class="text-danger">(*)</span></label>
                                        <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                            placeholder="Tên đăng nhập" name="user_name" value="{{ old('user_name') }}">
                                        @error('user_name')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">Mật khẩu <span class="text-danger">(*)</span></label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Mật khẩu" name="password">
                                        @error('password')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label" for="password-confirm">Xác nhận mật khẩu <span
                                                class="text-danger">(*)</span></label>
                                        <input type="password" id="password-confirm"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Nhập lại mật khẩu" autocomplete="new-password"
                                            name="password_confirmation">
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
                            <h6 class="card-title">Thông tin chi tiết</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">Email <span class="text-danger">(*)</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="admin@gmail.com" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30 cm-content-body form excerpt">
                                    <label class="form-label">Vai trò <span class="text-danger">(*)</span></label>
                                    <select
                                        class="form-control default-select h-auto wide @error('role') is-invalid @enderror"
                                        name="role">
                                        <option value="">-- Chọn vai trò --</option>
                                        <option value="{{ ROLE_ADMIN }}" {{ old('role') == ROLE_ADMIN ? 'selected' : '' }}> Admin </option>
                                        <option value="{{ ROLE_UNIVERSITY }}" {{ old('role') == ROLE_UNIVERSITY ? 'selected' : '' }}> Trường học
                                        </option>
                                        <option value="{{ ROLE_COMPANY }}" {{ old('role') == ROLE_COMPANY ? 'selected' : '' }}> Doanh nghiệp
                                        </option>
                                    </select>
                                    @error('role')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
                            <button class="btn btn-success" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection
