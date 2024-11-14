@extends('management.layout.main')

@section('title', 'Cập nhật thông tin doanh nghiệp')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item " aria-current="page">
                                <a href="{{ route('companyProfile', ['slug' => $companyInfo->slug]) }}">Hồ sơ doanh
                                    nghiệp</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Chỉnh sửa thông tin
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="clearfix" style="position:sticky; top: 50px">
                    <div class="card card-bx profile-card author-profile m-b30">
                        <div class="card-body">
                            <div class="p-5">
                                <div class="author-profile">
                                    <form
                                        action="{{ route('companyProfileUpdateAvatar', ['slug' => $companyInfo->slug]) }}"
                                        method="post" enctype="multipart/form-data"
                                        id="updateImageForm">
                                        @method('PATCH')
                                        @csrf
                                        <div class="author-media">
                                            <img id="uploadedImage"
                                                 style="border-radius: 100%; width: 150px; height: 140px; object-fit: cover;"
                                                 src="{{ $companyInfo->avatar_path ? asset('storage/'.$companyInfo->avatar_path) : asset('management-assets/images/user.jpg') }}"
                                                 alt=""/>

                                            <div class="upload-link" title="" data-toggle="tooltip"
                                                 data-placement="right" data-original-title="update">
                                                <input type="file" class="update-flie" name="avatar_path"
                                                       id="avatarInput"/>
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="author-info">
                                        <h6 class="title">{{ $companyInfo->name }}</h6>
                                        <span>Doanh nghiệp</span>
                                    </div>
                                </div>
                            </div>
                            <div class="info-list">
                                <ul>
                                    <li class="">
                                        <p>Ngày tham gia</p> <span>{{ date_format($companyInfo->created_at, 'd/m/Y') }}</span>
                                    </li>
                                    <li class="">
                                        <p>Lần cập nhật gần nhất</p> <span>{{ date_format($companyInfo->updated_at, 'd/m/Y') }}</span>
                                    </li>
                                    <li>
                                        <p>Quy mô</p><span>{{ $companyInfo->size}} tv</span>
                                    </li>
                                    <li>
                                        <p>Số job đã đăng</p><span>10</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="form-control rounded text-center mb-3">
                                    {{ $companyInfo->user->email }}
                                </div>
                                <div class="input-group">
                                    <a href="" target="_blank" class="form-control btn-primary rounded text-center">Thay
                                        đổi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card profile-card card-bx m-b30">
                    <div class="card-header">
                        <h6 class="card-title">Cập nhật thông tin</h6>
                    </div>
                    <form action="{{ route('companyProfileUpdate', $companyInfo->slug) }}" method="post"
                          enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label"><span class="text-danger">*</span>Tên:</label>
                                    <input type="text" name="name" id="name" oninput="ChangeToSlug()" class="form-control"
                                           placeholder="Tổ chức xã hội trắng Duy Lập"
                                           value="{{ old('name', $companyInfo->name) }}"/>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label"> <span class="text-danger">*</span>Slug:</label>
                                    <input type="text" name="slug" id="slug" oninput="ChangeToSlug()" class="form-control"
                                           placeholder="to-chuc-xa-hoi-trang-duy-lap"
                                           value=" {{ old('slug',$companyInfo->slug) }}"/>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label"><span class="text-danger">*</span>Số điện thoại: </label>
                                    <input type="number" class="form-control" name="phone"
                                           value="{{ old('phone',$companyInfo->phone) }}"
                                           placeholder="012345678"/>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label"><span class="text-danger">*</span>Quy mô: </label>
                                    <input type="number" class="form-control" name="size"
                                           value="{{old('size', $companyInfo->size) }}"
                                           placeholder="300"/>
                                    @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5> Địa chỉ: </h5>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="province-select"><span
                                            class="text-danger">*</span>Tỉnh/Thành phố</label>
                                    <select name="province_id" class="form-control default-select"
                                            id="province-select" onchange="fetchDistricts()">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                        @foreach($companyInfo->provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id', $companyInfo->address->province_id) == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="district-select"><span
                                            class="text-danger">*</span>Quận/Huyện</label>
                                    <select name="district_id" class="form-control default-select"
                                            id="district-select" onchange="fetchWards()">
                                        <option value="">Chọn Quận/Huyện</option>
                                        {{--                                        @foreach($companyInfo->districts as $district)--}}
                                        {{--                                            <option value="{{ $district['id'] }}"--}}
                                        {{--                                                {{ old('district_id', $companyInfo->address->district_id) == $district['id'] ? 'selected' : '' }}>--}}
                                        {{--                                                {{ $district['name'] }}--}}
                                        {{--                                            </option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                    @error('district_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="ward-select"><span
                                            class="text-danger">*</span>Xã/Phường</label>
                                    <select name="ward_id" class="form-control"
                                            id="ward-select">
                                        <option value="">Chọn Xã/Phường</option>
                                        {{--                                        @foreach($companyInfo->wards as $ward)--}}
                                        {{--                                            <option value="{{ $ward['id'] }}"--}}
                                        {{--                                                {{ old('ward_id', $companyInfo->address->ward_id) == $ward['id'] ? 'selected' : '' }}>--}}
                                        {{--                                                {{ $ward['name'] }}--}}
                                        {{--                                            </option>--}}
                                        {{--                                        @endforeach--}}
                                    </select>
                                    @error('ward_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="specific-select"><span
                                            class="text-danger">*</span>Địa chỉ chi tiết</label>
                                    <input type="text" name="specific_address" class="form-control" id="specific-select"
                                           value="{{ old('specific_address', $companyInfo->address->specific_address) }}"
                                           placeholder="Nhập số nhà, tên đường..."
                                           minlength="5"
                                           maxlength="255">
                                    @error('specific_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 m-b30">
                                    <label class="form-label d-block"><span class="text-danger">*</span>Map</label>
                                    <textarea class="form-control"
                                              name="map"> {{ old('map' ,$companyInfo->map) }}</textarea>
                                    @error('map')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label d-block"><span class="text-danger">*</span>Mô tả</label>
                                    <textarea class="form-control"
                                              name="description"> {{ old('description', $companyInfo->description) }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label d-block"><span class="text-danger">*</span>Giới
                                        thiệu</label>
                                    <textarea id="content_2" name="about"
                                              class="form-control tinymce_editor_init"
                                              rows="">{{ old('about',$companyInfo->about) }}</textarea>
                                    @error('about')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>

        // Thêm CSRF token vào header của tất cả request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fetchDistricts() {
            const provinceSelect = document.getElementById('province-select');
                const districtSelect = document.getElementById('district-select');
                const wardSelect = document.getElementById('ward-select');
            const specificAddressInput = document.getElementById('specific-select');

            // Reset các dropdown phụ thuộc
            districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
            wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';

            // Disable các trường phụ thuộc
            wardSelect.disabled = true;
            // specificAddressInput.disabled = true;

            if (provinceSelect.value) {
                // Hiển thị loading state
                districtSelect.disabled = true;

                $.ajax({
                    url: `/districts/${provinceSelect.value}`,
                    method: 'GET',
                    success: function (response) {
                        districtSelect.disabled = false;
                        // console.log(response)
                        // Thêm các options mới
                        response.forEach(function (district) {
                            const option = new Option(district.name, district.id);
                            districtSelect.add(option);
                            // console.log(option)
                        });

                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi tải danh sách quận/huyện');
                    }
                });
            }
        }

        function fetchWards() {
            const districtSelect = document.getElementById('district-select');
            const wardSelect = document.getElementById('ward-select');
            const specificAddressInput = document.getElementById('specific-select');

            // Reset ward dropdown
            wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';
            // specificAddressInput.disabled = true;

            if (districtSelect.value) {
                // Hiển thị loading state
                wardSelect.disabled = true;

                $.ajax({
                    url: `/wards/${districtSelect.value}`,
                    method: 'GET',
                    success: function (response) {
                        console.log(response.data)
                        wardSelect.disabled = false;

                        // Thêm các options mới
                        response.forEach(function (ward) {
                            const option = new Option(ward.name, ward.id);
                            wardSelect.add(option);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi tải danh sách phường/xã');
                    }
                });
            }
        }

        // Enable specific address input khi chọn ward
        $(document).on('change', '#ward-select', function () {
            const specificAddressInput = document.getElementById('specific-select');
            specificAddressInput.disabled = !this.value;
        });

        // Khởi tạo form nếu có dữ liệu
        $(document).ready(function () {
            if ($('#province-select').val()) {
                fetchDistricts();
            }
            if ($('#district-select').val()) {
                fetchWards();
            }
            if ($('#ward-select').val()) {
                $('#specific-select').prop('disabled', false);
            }
        });

    </script>
    {{--    <script>--}}
    {{--        async function fetchDistricts(province_id) {--}}
    {{--            try {--}}
    {{--                const response = await fetch(`/districts/${province_id}`);--}}

    {{--                // Kiểm tra nếu phản hồi thành công--}}
    {{--                if (!response.ok) {--}}
    {{--                    throw new Error('Network response was not ok');--}}
    {{--                }--}}

    {{--                // Chuyển dữ liệu thành JSON--}}
    {{--                const data = await response.json();--}}
    {{--                // Xử lý dữ liệur--}}
    {{--                console.log(data);--}}
    {{--                return data;--}}
    {{--            } catch (error) {--}}
    {{--                // Xử lý lỗi--}}
    {{--                console.error('There has been a problem with your fetch operation:', error);--}}
    {{--                throw error;--}}
    {{--            }--}}
    {{--        }--}}

    {{--        async function fetchWards() {--}}
    {{--            try {--}}
    {{--                const response = await fetch(`/wards/${1}`);--}}

    {{--                // Kiểm tra nếu phản hồi thành công--}}
    {{--                if (!response.ok) {--}}
    {{--                    throw new Error('Network response was not ok');--}}
    {{--                }--}}

    {{--                // Chuyển dữ liệu thành JSON--}}
    {{--                const data = await response.json();--}}
    {{--                // Xử lý dữ liệur--}}
    {{--                console.log(data);--}}
    {{--                return data;--}}
    {{--            } catch (error) {--}}
    {{--                // Xử lý lỗi--}}
    {{--                console.error('There has been a problem with your fetch operation:', error);--}}
    {{--                throw error;--}}
    {{--            }--}}
    {{--        }--}}

    {{--        async function getDistricts() {--}}
    {{--            const provinceSelect = document.getElementById('province-select');--}}
    {{--            const districtSelect = document.getElementById('district-select');--}}
    {{--            const wardSelect = document.getElementById('ward-select');--}}
    {{--            const specificAddressInput = document.getElementById('specific-select');--}}
    {{--            const filterOption = document.getElementsByClassName('filter-option-inner');--}}
    {{--            console.log(filterOption)--}}
    {{--            districtSelect.innerHTML += '<option value="">Check</option>'--}}
    {{--            // districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';--}}
    {{--            console.log(districtSelect.innerHTML)--}}
    {{--            try {--}}
    {{--                return--}}
    {{--                const data = await fetchDistricts(provinceSelect.value);--}}
    {{--                data.forEach(function (district) {--}}
    {{--                    const option = new Option(district.name, district.id);--}}
    {{--                    districtSelect.add(option);--}}
    {{--                });--}}
    {{--            } catch (error) {--}}
    {{--                console.log(error)--}}
    {{--            }--}}
    {{--        }--}}


    {{--    </script>--}}
    <script>
        document.getElementById('avatarInput').addEventListener('change', function (event) {
            const formData = new FormData();
            const fileInput = event.target;
            const avatarImage = document.getElementById('uploadedImage');

            if (fileInput.files.length > 0) {
                formData.append('avatar_path', fileInput.files[0]);

                fetch(`{{ route('companyProfileUpdateAvatar', ['slug' => $companyInfo->slug]) }}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            avatarImage.src = data.imageUrl;
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Cập nhật ảnh thành công"
                            });
                        } else {
                            alert('Cập nhật ảnh thất bại!');
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi:', error);
                        alert('Đã xảy ra lỗi khi tải ảnh!');
                    });
            }
        });
    </script>
@endsection
