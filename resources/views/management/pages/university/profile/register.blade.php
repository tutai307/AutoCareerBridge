@extends('management.layout.main')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Đăng ký thông tin hồ sơ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card profile-card card-bx m-b30">
                <div class="card-header">
                    <h6 class="text-primary card-title">Thông tin hồ sơ trường</h6>
                </div>
                <div class="card-body">
                    <form id="update-university-form" method="POST"
                        action="{{ route('university.handleRegister', ['user_id' => request('id')]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Tên trường</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    oninput="ChangeToSlug()" placeholder="Trường Đại Học Công Nghiệp Hà Nội">
                                @error('name')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Slug URL</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                    placeholder="dhcn-hn">
                                @error('slug')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Tên viết tắt</label>
                                <input type="text" class="form-control" id="abbreviation" name="abbreviation"
                                    placeholder="HAUI">
                                @error('abbreviation')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Website</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    placeholder="https://www.haui.edu.vn/vn">
                                @error('website')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Tỉnh/Thành phố --}}
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Tỉnh/Thành phố</label>
                                <div class="dropdown bootstrap-select default-select wide form-control dropup">
                                    <select class="form-control" id="province" name="province">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                    </select>
                                    @error('province')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Quận/Huyện</label>
                                <div class="dropdown bootstrap-select default-select wide form-control dropup">
                                    <select class="form-control" id="district" name="district">
                                        <option value="">Chọn Quận/Huyện</option>
                                    </select>
                                    @error('district')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Phường/Xã</label>
                                <div class="dropdown bootstrap-select default-select wide form-control dropup">
                                    <select class="form-control" id="ward" name="ward">
                                        <option value="">Chọn Phường/Xã</option>
                                    </select>
                                    @error('ward')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Địa chỉ chi tiết --}}
                            <div class="col-sm-6 m-b30">
                                <label class="form-label required">Địa chỉ cụ thể</label>
                                <input type="text" class="form-control" id="university-specific-address"
                                    name="specific_address" placeholder="Số 298, Đường Cầu Diễn">
                                @error('specific_address')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 m-b30">
                                <label class="form-label required">Giới thiệu</label>
                                <textarea name="intro" rows="10" class="ckeditor" id="university-intro" cols="80"></textarea>
                                @error('intro')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 m-b30">
                                <label class="form-label required">Mô tả</label>
                                <textarea name="description" rows="10" class="ckeditor" id="university-des" cols="80"></textarea>
                                @error('description')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" id="registerBtn">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
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
                        provinceSelect.append('<option value="">Chọn Tỉnh/Thành phố</option>');
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
                        districtSelect.append('<option value="">Chọn Quận/Huyện</option>');
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
                        wardSelect.append('<option value="">Chọn Phường/Xã</option>');
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

    {{-- <script>
        $(document).ready(function() {
            $("#registerBtn").on("click", function(e) {
                const form = $("#update-university-form");
                e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                let formData = new FormData(form[0]);
                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Đăng ký thành công!',
                                text: data.message,
                                timer: 1500, // Tự động đóng sau 1.5 giây
                                showConfirmButton: false,
                            }).then(() => {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Có lỗi xảy ra!',
                                text: 'Vui lòng thử lại.',
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Lỗi xác thực từ Laravel
                            const response = xhr.responseJSON;
                            if (response.errors) {
                                // Lặp qua các lỗi và hiển thị chúng
                                for (const [field, messages] of Object.entries(response
                                    .errors)) {
                                    const errorContainer = $(`#${field}-error`);
                                    if (errorContainer.length) {
                                        errorContainer.text(messages[
                                        0]); // Hiển thị lỗi đầu tiên
                                        errorContainer.addClass(
                                        'text-danger'); // Thêm class lỗi
                                    }
                                }
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi không xác định!',
                                text: 'Vui lòng thử lại sau.',
                            });
                            console.error(xhr.responseText);
                        }
                    }
                });
            });
        });
    </script> --}}
@endsection
