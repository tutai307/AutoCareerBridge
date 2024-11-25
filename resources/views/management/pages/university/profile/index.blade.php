@extends('management.layout.main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quản lý hồ sơ</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        {!! $university->map !!}
                    </div>
                    <div class="profile-info">
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">Email
                                </h4>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{ $university->user->email ?? 'Không có email' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="clearfix">
                <div class="card card-bx profile-card author-profile m-b30">
                    <div class="card-body">
                        <div class="p-5">
                            <div class="author-profile">
                                <div class="author-media">
                                    <img id="uploadedImage"
                                        src="{{ $university->avatar_path ? asset('storage/' . $university->avatar_path) : 'https://img.freepik.com/premium-vector/university-icon-logo-element-illustration-university-symbol-design-from-2-colored-collection-simple-university-concept-can-be-used-web-mobile_159242-5088.jpg' }}"
                                        alt="">
                                    <form id="uploadForm">
                                        @csrf
                                        <div class="upload-link" title="" data-toggle="tooltip" data-placement="right"
                                            data-original-title="update">
                                            <input type="file" class="update-flie" id="university_image"
                                                name="university_image">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </form>
                                </div>

                                <div class="author-info">
                                    <h6 class="title">
                                        {{ $university->name . ' (' . ($university->abbreviation ?? 'Chưa có tên viết tắt') . ')' }}
                                    </h6>
                                    <span>{{ $university->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-list">
                            <ul>
                                <li><a href="#">Quy mô</a><span>{{ 'Chưa cập nhật' }}</span>
                                </li>
                                <li><a href="#">Chương trình đào
                                        tạo</a><span>{{ 'Chưa cập nhật' }}</span></li>
                                <li><a href="#">Doanh nghiệp cộng tác</a><span>30</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-3">
                            <div class="form-control rounded text-center">Trang web nhà trường</div>
                        </div>
                        <div class="input-group">
                            <a href="{{ $university->website_link ?? '#' }}" target="_blank"
                                class="form-control text-primary rounded text-center">{{ $university->website_link ?? '#' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="card profile-card card-bx m-b30">
                <div class="card-header">
                    <h6 class="text-primary card-title">Thông tin hồ sơ trường</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 m-b20">
                            <label class="form-label text-primary">Giới thiệu</label>
                            <p>{!! $university->about ?? 'Không có thông tin' !!}</p>
                        </div>
                        <div class="col-sm-12 m-b20">
                            <label class="form-label text-primary">Mô tả</label>
                            <p style="white-space: pre-wrap;">{!! $university->description ?? 'Không có thông tin' !!}
                            </p>
                        </div>
                        <div class="col-sm-12 m-b20">
                            <label class="form-label text-primary">Địa chỉ</label>
                            <p>{{ $address ?? 'Chưa cập nhật thông tin' }}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Include update blade --}}

                <div class="card-footer">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                        data-bs-target=".modal_update_university">Cập nhật thông tin</button>
                </div>
                <form action="{{ route('univertsity.profileUpdate', ['id' => $university->id]) }}" method="POST"
                    id="update-university-form">
                    @csrf
                    @include('management.pages.university.profile.update')
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const iframe = document.querySelector('div.photo-content iframe');
            if (iframe) {
                iframe.classList.add('place-map');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                // Gửi AJAX
                $.ajax({
                    url: '{{ route('university.profileUploadImage') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#uploadedImage').attr('src', response.image_url);
                            Swal.fire({
                                icon: 'success',
                                title: 'Cập nhật ảnh thành công!',
                                position: 'top-end',
                                toast: true,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Có lỗi xảy ra',
                                text: response.message,
                                position: 'top-end',
                                toast: true,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            var errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] +
                                    '\n';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi xác thực',
                                text: errorMessages,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Có lỗi xảy ra',
                                text: xhr.responseJSON.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });

            $('#university_image').on('change', function() {
                $('#uploadForm').submit(); // Gửi form khi chọn ảnh
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Hàm để tải dữ liệu Tỉnh/Thành phố
            function loadProvinces() {
                $.ajax({
                    url: '/api/provinces', // Đường dẫn API của bạn
                    method: 'GET',
                    success: function(response) {
                        var provinceSelect = $('#province');
                        provinceSelect.empty(); // Xóa tất cả option hiện tại
                        response.forEach(function(province) {
                            provinceSelect.append('<option value="' + province.id + '">' +
                                province.name + '</option>');
                        });
                        provinceSelect.selectpicker('refresh'); // Làm mới Bootstrap Select
                    }
                });
            }

            // Hàm tải dữ liệu Quận/Huyện
            function loadDistricts(provinceId) {
                $.ajax({
                    url: '/api/districts/' + provinceId, // Đường dẫn API lấy quận huyện theo tỉnh
                    method: 'GET',
                    success: function(response) {
                        var districtSelect = $('#district');
                        districtSelect.empty(); // Xóa tất cả option hiện tại
                        response.forEach(function(district) {
                            districtSelect.append('<option value="' + district.id + '">' +
                                district.name + '</option>');
                        });
                        districtSelect.selectpicker('refresh'); // Làm mới Bootstrap Select
                    }
                });
            }

            // Hàm tải dữ liệu Phường/Xã
            function loadWards(districtId) {
                $.ajax({
                    url: '/api/wards/' + districtId, // Đường dẫn API lấy phường xã theo quận
                    method: 'GET',
                    success: function(response) {
                        var wardSelect = $('#ward');
                        wardSelect.empty(); // Xóa tất cả option hiện tại
                        response.forEach(function(ward) {
                            wardSelect.append('<option value="' + ward.id + '">' + ward.name +
                                '</option>');
                        });
                        wardSelect.selectpicker('refresh'); // Làm mới Bootstrap Select
                    }
                });
            }

            // Tải dữ liệu Tỉnh/Thành phố khi trang được tải
            loadProvinces();

            // Khi chọn tỉnh/thành phố, tải dữ liệu Quận/Huyện tương ứng
            $('#province').on('change', function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    loadDistricts(provinceId);
                } else {
                    $('#district').empty().selectpicker('refresh');
                    $('#ward').empty().selectpicker('refresh');
                }
            });

            // Khi chọn quận/huyện, tải dữ liệu Phường/Xã tương ứng
            $('#district').on('change', function() {
                var districtId = $(this).val();
                if (districtId) {
                    loadWards(districtId);
                } else {
                    $('#ward').empty().selectpicker('refresh');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if ($errors->any())
                // Mở modal nếu có lỗi trong session
                const modalUpdateUniversity = new bootstrap.Modal(document.getElementById('modal_update_university'));
                modalUpdateUniversity.show();
            @endif
        });
    </script>
@endsection
