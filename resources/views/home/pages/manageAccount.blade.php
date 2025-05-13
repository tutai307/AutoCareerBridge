@extends('home.layouts.app')
@section('title','Quản lý tài khoản')
@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-lg-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="position-relative mx-auto" style="width: 150px; height: 150px; overflow: hidden; border-radius: 50%;">
                            <img src="{{ asset('storage/' . Auth::guard('student')->user()->avatar_path) }}"
                            alt="avatar"
                            class="img-fluid"
                            style="width: 100%; height: 100%; object-fit: cover;">
                            <form method="POST" id="uploadAvatar">
                                @csrf
                                <div class="position-absolute" style="bottom: 5px; right: 55px;">
                                    <label for="avatar_upload" class="btn rounded-circle p-1"
                                        style="cursor: pointer; background-color: #0d6efd; width: 35px; height: 35px;">
                                        <i class="fa fa-camera text-white"></i>
                                    </label>
                                    <input type="file" class="d-none" id="avatar_upload" name="avatar" accept="image/*">
                                </div>
                            </form>
                        </div>
                        <h5 class="my-3 text-primary">{{ Auth::guard('student')->user()->name }}</h5>
                        <p class="mb-4 text-muted">{{ Auth::guard('student')->user()->university->name }}</p>
                        {{-- Có thể thêm các nút hoặc thông tin khác ở đây --}}
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3" id="account-nav">
                            {{-- Sử dụng nav-link của Bootstrap và data-bs-toggle để kích hoạt tab --}}
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3 nav-item"
                                role="presentation">
                                <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                    role="tab" aria-controls="profile" aria-selected="true">
                                    <i class="fas fa-user-circle fa-lg text-warning"></i>
                                    <span class="fw-bold m-2">Thông tin cá nhân</span>
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3 nav-item"
                                role="presentation">
                                <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab"
                                    aria-controls="password" aria-selected="false">
                                    <i class="fas fa-key fa-lg" style="color: #333333;"></i>
                                    <span class="fw-bold m-2">Đổi mật khẩu</span>
                                </a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3 nav-item"
                                role="presentation">
                                <a class="nav-link" id="notifications-tab" data-bs-toggle="tab" href="#notifications"
                                    role="tab" aria-controls="notifications" aria-selected="false">
                                    <i class="fas fa-bell fa-lg" style="color: #55acee;"></i>
                                    <span class="fw-bold m-2">Thông báo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                {{-- Tab content --}}
                <div class="tab-content" id="account-tabContent">
                    <!-- Thông tin cá nhân Tab Pane -->
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0 text-primary">Thông tin cá nhân</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('manageAccount.updateProfile') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Họ và tên</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext">{{ Auth::guard('student')->user()->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Chuyên ngành</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext">
                                                {{ Auth::guard('student')->user()->major->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Năm nhập học</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext">
                                                {{ \Carbon\Carbon::parse(Auth::guard('student')->user()->entry_year)->format('d-m-Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Năm tốt nghiệp</label>
                                        <div class="col-sm-9">
                                            <p class="form-control-plaintext">
                                                {{ \Carbon\Carbon::parse(Auth::guard('student')->user()->graduation_year)->format('d-m-Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ Auth::guard('student')->user()->email }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                        <div class="col-sm-9">
                                            <input type="tel" class="form-control" name="phone"
                                                value="{{ Auth::guard('student')->user()->phone }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Đổi mật khẩu Tab Pane -->
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Đổi mật khẩu</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('manageAccount.updatePassword') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Mật khẩu hiện tại</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="current_password" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Xác nhận mật khẩu mới</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Thông báo Tab Pane (Placeholder) -->
                    <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Thông báo</h5>
                            </div>
                            <div class="card-body">
                                <p>Chức năng thông báo đang được phát triển.</p>
                                {{-- Nội dung cho phần thông báo sẽ ở đây --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .list-group-item {
            /* Bỏ border mặc định và padding để thẻ a chiếm toàn bộ */
            border: none;
            padding: 0;
        }

        /* Style cho nav-link trong list-group */
        .list-group-item .nav-link {
            padding: 1rem 1.25rem;
            /* Giữ padding gốc của list-group-item */
            color: #495057;
            /* Màu chữ mặc định */
            display: block;
            /* Đảm bảo thẻ a chiếm toàn bộ li */
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .list-group-item .nav-link:hover {
            background-color: #f8f9fa;
            /* Màu nền khi hover */
            color: #0d6efd;
            /* Màu chữ khi hover */
        }

        .list-group-item .nav-link.active {
            background-color: #007bff;
            color: white;
            /* Màu chữ khi active */
            font-weight: bold;
        }

        /* Căn chỉnh form */
        .col-form-label {
            text-align: right;
        }

        /* Responsive cho label trên mobile */
        @media (max-width: 575.98px) {
            .col-form-label {
                text-align: left;
            }
        }
    </style>
@endpush

@section('scripts')
    <script>
        $(document).ready(function() {
            // Kiểm tra xem form và input có tồn tại không
            console.log('Form exists:', $('#uploadAvatar').length);
            console.log('Input exists:', $('#avatar_upload').length);

            // Thêm sự kiện change cho input file
            $(document).on('change', '#avatar_upload', function() {
                console.log('File change event triggered');
                var formData = new FormData($('#uploadAvatar')[0]);

                // Kiểm tra file được chọn
                if (this.files.length > 0) {
                    $.ajax({
                        url: "{{ route('manageAccount.updateAvatar') }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log('Upload success:', response);
                            if(response.success) {
                                toastr.success('Cập nhật ảnh đại diện thành công');
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else {
                                toastr.error('Có lỗi xảy ra khi cập nhật ảnh đại diện');
                            }
                        },
                        error: function(xhr) {
                            console.log('Upload error:', xhr);
                            if(xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            } else {
                                toastr.error('Có lỗi xảy ra khi cập nhật ảnh đại diện');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
