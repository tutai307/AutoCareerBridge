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
                    <h6 class="card-title">Thông tin hồ sơ trường</h6>
                </div>
                <div class="card-body">
                    <form id="update-university-form" method="POST"
                        action="{{ route('university.handleRegister', ['user_id' => request('id')]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Tên trường</label>
                                <input value="{{ old('name') }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    oninput="ChangeToSlug()" placeholder="Trường Đại Học Công Nghiệp Hà Nội">
                                @error('name')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Slug URL</label>
                                <input value="{{ old('slug') }}" type="text"
                                    class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                    placeholder="dhcn-hn">
                                @error('slug')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Tên viết tắt</label>
                                <input value="{{ old('abbreviation') }}" type="text"
                                    class="form-control @error('abbreviation') is-invalid @enderror" id="abbreviation"
                                    name="abbreviation" placeholder="HAUI">
                                @error('abbreviation')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Website</label>
                                <input value="{{ old('website') }}" type="text"
                                    class="form-control @error('website') is-invalid @enderror" id="website"
                                    name="website" placeholder="https://www.haui.edu.vn/vn">
                                @error('website')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Tỉnh/Thành phố</label>
                                <div class="dropdown bootstrap-select default-select wide form-control dropdown">
                                    <select class="form-control @error('province') is-invalid @enderror" id="province"
                                        name="province">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                    </select>
                                    @error('province')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Quận/Huyện</label>
                                <div class="dropdown bootstrap-select default-select wide form-control dropdown">
                                    <select class="form-control @error('district') is-invalid @enderror" id="district"
                                        name="district">
                                        <option value="">Chọn Quận/Huyện</option>
                                    </select>
                                    @error('district')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Phường/Xã</label>
                                <div class="dropdown bootstrap-select default-select wide form-control dropdown">
                                    <select class="form-control @error('ward') is-invalid @enderror" id="ward"
                                        name="ward">
                                        <option value="">Chọn Phường/Xã</option>
                                    </select>
                                    @error('ward')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 m-b30">
                                <label class="form-label fw-semibold required">Địa chỉ cụ thể</label>
                                <input value="{{ old('specific_address') }}" type="text"
                                    class="form-control @error('specific_address') is-invalid @enderror"
                                    id="university-specific-address" name="specific_address"
                                    placeholder="Số 298, Đường Cầu Diễn">
                                @error('specific_address')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 m-b30">
                                <label class="form-label fw-semibold required">Giới thiệu</label>
                                <textarea name="intro" rows="10" class="ckeditor form-control @error('intro') is-invalid @enderror"
                                    id="university-intro" cols="80">{{ old('intro') }}</textarea>
                                @error('intro')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 m-b30">
                                <label class="form-label fw-semibold required">Mô tả</label>
                                <textarea name="description" rows="10" class="ckeditor form-control @error('description') is-invalid @enderror"
                                    id="university-des" cols="80">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="d-block text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 m-b30 text-end">
                                <button type="submit" class="btn btn-primary" id="registerBtn">Đăng ký</button>
                            </div>
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
            // Giá trị cũ từ backend (nếu có)
            var oldProvince = "{{ old('province') }}";
            var oldDistrict = "{{ old('district') }}";
            var oldWard = "{{ old('ward') }}";

            // Hàm để tải dữ liệu Tỉnh/Thành phố
            function loadProvinces(selectedProvince = null) {
                $.ajax({
                    url: '/api/provinces', // Đường dẫn API của bạn
                    method: 'GET',
                    success: function(response) {
                        var provinceSelect = $('#province');
                        provinceSelect.empty(); // Xóa tất cả option hiện tại
                        provinceSelect.append('<option value="">Chọn Tỉnh/Thành phố</option>');
                        response.forEach(function(province) {
                            var isSelected = selectedProvince == province.id ? 'selected' : '';
                            provinceSelect.append('<option value="' + province.id + '" ' +
                                isSelected + '>' + province.name + '</option>');
                        });
                        provinceSelect.selectpicker('refresh'); // Làm mới Bootstrap Select

                        if (selectedProvince) {
                            loadDistricts(selectedProvince, oldDistrict); // Tải dữ liệu quận/huyện
                        }
                    }
                });
            }

            // Hàm tải dữ liệu Quận/Huyện
            function loadDistricts(provinceId, selectedDistrict = null) {
                $.ajax({
                    url: '/api/districts/' + provinceId, // Đường dẫn API lấy quận huyện theo tỉnh
                    method: 'GET',
                    success: function(response) {
                        var districtSelect = $('#district');
                        districtSelect.empty(); // Xóa tất cả option hiện tại
                        districtSelect.append('<option value="">Chọn Quận/Huyện</option>');
                        response.forEach(function(district) {
                            var isSelected = selectedDistrict == district.id ? 'selected' : '';
                            districtSelect.append('<option value="' + district.id + '" ' +
                                isSelected + '>' + district.name + '</option>');
                        });
                        districtSelect.selectpicker('refresh'); // Làm mới Bootstrap Select

                        if (selectedDistrict) {
                            loadWards(selectedDistrict, oldWard); // Tải dữ liệu phường/xã
                        }
                    }
                });
            }

            // Hàm tải dữ liệu Phường/Xã
            function loadWards(districtId, selectedWard = null) {
                $.ajax({
                    url: '/api/wards/' + districtId, // Đường dẫn API lấy phường xã theo quận
                    method: 'GET',
                    success: function(response) {
                        var wardSelect = $('#ward');
                        wardSelect.empty(); // Xóa tất cả option hiện tại
                        wardSelect.append('<option value="">Chọn Phường/Xã</option>');
                        response.forEach(function(ward) {
                            var isSelected = selectedWard == ward.id ? 'selected' : '';
                            wardSelect.append('<option value="' + ward.id + '" ' + isSelected +
                                '>' + ward.name + '</option>');
                        });
                        wardSelect.selectpicker('refresh'); // Làm mới Bootstrap Select
                    }
                });
            }

            // Tải dữ liệu Tỉnh/Thành phố khi trang được tải
            loadProvinces(oldProvince);

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
        const links = document.querySelectorAll('.dlabnav-scroll a');
        // Lặp qua từng thẻ a và thêm sự kiện click
        links.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Ngăn chặn chuyển hướng
                toastr.error("", "Vui lòng cập nhật thông tin")
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các input và select trên form
            const inputs = document.querySelectorAll("input, select, textarea");

            inputs.forEach(input => {
                input.addEventListener("input", function() {
                    // Xóa lớp is-invalid nếu người dùng nhập giá trị
                    if (input.value.trim() !== "") {
                        input.classList.remove("is-invalid");

                        // Xóa thông báo lỗi nếu có
                        const errorMessage = input.closest(".col-sm-6, .col-sm-12").querySelector(
                            ".text-danger");
                        if (errorMessage) {
                            errorMessage.style.display = "none";
                        }
                    }
                });

                // Xử lý trường hợp select thay đổi
                if (input.tagName === "SELECT") {
                    input.addEventListener("change", function() {
                        input.classList.remove("is-invalid");
                        const errorMessage = input.closest(".col-sm-6, .col-sm-12").querySelector(
                            ".text-danger");
                        if (errorMessage) {
                            errorMessage.style.display = "none";
                        }
                    });
                }
            });
        });
    </script>
@endsection
l
