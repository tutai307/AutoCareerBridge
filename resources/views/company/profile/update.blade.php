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
                                <a href="{{ route('company.profile', ['slug' => $companyInfo->slug ?? 'no-slug']) }}">Hồ
                                    sơ doanh
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
                                        action="{{ route('company.profileUpdateAvatar', ['slug' => $companyInfo->slug ?? $userID]) }}"
                                        method="post" enctype="multipart/form-data" id="updateImageForm">
                                        @method('PATCH')
                                        @csrf
                                        <div class="author-media">
                                            <img id="uploadedImage"
                                                 style="border-radius: 100%; width: 150px; height: 140px; object-fit: cover;"
                                                 src="{{isset($companyInfo->avatar_path) ? asset('storage/'.$companyInfo->avatar_path) : asset('management-assets/images/user.jpg') }}"
                                                 alt=""/>

                                            <div class="upload-link" title="" data-toggle="tooltip"
                                                 data-placement="right"
                                                 data-original-title="update">
                                                <input type="file" class="update-flie" name="avatar_path"
                                                       id="avatarInput"/>
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="author-info">
                                        <h6 class="title">{{ $companyInfo->name ?? '' }}</h6>
                                        <span>Doanh nghiệp</span>
                                    </div>
                                </div>
                            </div>
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <p>Ngày tham gia: </p> <span> @if (isset($companyInfo->created_at))
                                                {{ date_format($companyInfo->created_at, 'd/m/Y')}}
                                            @endif</span>
                                    </li>
                                    <li>
                                        <p>Lần cập nhật gần nhất: </p> <span> @if (isset($companyInfo->updated_at))
                                                {{ date_format($companyInfo->updated_at, 'd/m/Y')}}
                                            @endif</span>
                                    </li>
                                    <li>
                                        <p>Quy mô</p><span>{{ $companyInfo->size ?? ''}} tv</span>
                                    </li>
                                    <li>
                                        <p>Số job đã đăng</p><span>10</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="form-control rounded text-center mb-3">
                                    {{ $companyInfo->user->email ?? '' }}
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
                    <form
                        action="{{route('company.profileUpdate', ['slug' => $companyInfo->slug ?? $userID])}}"
                        method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Tên công ty -->
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Tên:</label>
                                    <input type="text" name="name" id="name" oninput="ChangeToSlug()"
                                           class="form-control"
                                           placeholder="Tổ chức xã hội trắng Duy Lập"
                                           value="{{ old('name', $companyInfo->name ?? '') }}"/>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Slug:</label>
                                    <input type="text" name="slug" id="slug"
                                           class="form-control"
                                           placeholder="to-chuc-xa-hoi-trang-duy-lap"
                                           value="{{ old('slug', $companyInfo->slug ?? '') }}"/>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Số điện thoại: </label>
                                    <input type="number" class="form-control" name="phone"
                                           value="{{ old('phone',$companyInfo->phone ?? '') }}"
                                           placeholder="012345678"/>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">Quy mô: </label>
                                    <input type="number" class="form-control" name="size"
                                           value="{{old('size', $companyInfo->size ?? '') }}" placeholder="300"/>
                                    @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5> Địa chỉ: </h5>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block required" for="province-select">
                                        Tỉnh/Thành phố
                                    </label>
                                    <select name="province_id"
                                            class="form-control default-select"
                                            id="province-select"
                                            onchange="fetchDistricts()"
                                            data-live-search="true"
                                            data-width="100%"
                                            title="Chọn Tỉnh/Thành phố">
                                        <option value="">Chọn Tỉnh/Thành phố</option>
                                        @if(!empty($companyInfo->provinces))
                                            @foreach($companyInfo->provinces as $province)
                                                <option value="{{ $province->id }}"
                                                    {{ old('province_id', $companyInfo->address?->province_id ?? '') == $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('province_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label d-block required" for="district-select">
                                        Quận/Huyện
                                    </label>
                                    <select name="district_id" class="form-control default-select" id="district-select" onchange="fetchWards()">
                                        <option value="">Chọn Quận/Huyện</option>
                                        @if(!empty($companyInfo->districts))
                                            @foreach($companyInfo->districts as $district)
                                                <option value="{{ $district['id'] }}"
                                                    {{ old('district_id', $companyInfo->address?->district_id) == $district['id'] ? 'selected' : '' }}>
                                                    {{ $district['name'] }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('district_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label d-block required" for="ward-select">
                                        Xã/Phường
                                    </label>
                                    <select name="ward_id" class="form-control default-select" id="ward-select">
                                        <option value="">Chọn Xã/Phường</option>
                                        @if(!empty($companyInfo->wards))
                                            @foreach($companyInfo->wards as $ward)
                                                <option value="{{ $ward['id'] }}"
                                                    {{ old('ward_id', $companyInfo->address?->ward_id) == $ward['id'] ? 'selected' : '' }}>
                                                    {{ $ward['name'] }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('ward_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label d-block required" for="specific-select">
                                        Địa chỉ chi tiết
                                    </label>
                                    <input type="text" name="specific_address" class="form-control" id="specific-select"
                                           value="{{ old('specific_address', $companyInfo->address->specific_address ?? '') }}"
                                           placeholder="Nhập số nhà, tên đường..." minlength="5" maxlength="255">
                                    @error('specific_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mô tả công ty -->
                                <div class="col-12 m-b30">
                                    <label class="form-label">Mô tả công ty:</label>
                                    <textarea class="form-control" rows="10" name="description"
                                              placeholder="Nhập mô tả công ty...">{{ old('description', $companyInfo->description ?? '') }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Giới thiệu về công ty -->
                                <div class="col-12 m-b30">
                                    <label class="form-label">Giới thiệu về công ty:</label>
                                    <textarea id="content_2" name="about" class="form-control tinymce_editor_init"
                                              rows="">{{ old('about', $companyInfo->about ?? '') }}</textarea>
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
@section('css')
    @endsection
@section('js')

    <script>
        function fetchProvinces() {
            const currentProvinceId = document.getElementById('province-select').value;

            fetch('/company/provinces')
                .then(response => response.json())
                .then(data => {
                    const provinceSelect = document.getElementById('province-select');
                    provinceSelect.innerHTML = '<option value="">Chọn Tỉnh/Thành phố</option>';

                    data.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id;
                        option.textContent = province.name;
                        if (province.id == currentProvinceId) {
                            option.selected = true;
                        }
                        provinceSelect.appendChild(option);
                    });
                    $('.province-select').selectpicker('refresh');
                })
                .catch(error => {
                    console.error('Lỗi khi lấy danh sách tỉnh/thành phố:', error);
                });
        }

        function reloadProvinces() {
            fetchProvinces();
        }

        // Gọi hàm khi trang load
        document.addEventListener('DOMContentLoaded', fetchProvinces);
        async function fetchDistricts() {
            const provinceSelect = document.getElementById('province-select');
            const districtSelect = document.getElementById('district-select');
            const wardSelect = document.getElementById('ward-select');

            // Xóa các tùy chọn cũ
            districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
            wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';

            const provinceId = provinceSelect.value;

            if (provinceId) {
                try {
                    const response = await fetch(`/company/districts/${provinceId}`);
                    const districts = await response.json();

                    // Thêm các quận/huyện vào dropdown
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });

                    // Nếu đã có quận cũ được chọn (old value)
                    const oldDistrictId = "{{ old('district_id', $companyInfo->address->district_id ?? '') }}";
                    if (oldDistrictId) {
                        districtSelect.value = oldDistrictId;
                        fetchWards();  // Gọi để load xã/phường tương ứng
                    }
                } catch (error) {
                    console.error('Error fetching districts:', error);
                }
            }
        }

        async function fetchWards() {
            const districtSelect = document.getElementById('district-select');
            const wardSelect = document.getElementById('ward-select');

            // Xóa các tùy chọn cũ
            wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>';

            const districtId = districtSelect.value;

            if (districtId) {
                try {
                    const response = await fetch(`/company/wards/${districtId}`);
                    const wards = await response.json();

                    // Thêm các xã/phường vào dropdown
                    wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.id;
                        option.textContent = ward.name;
                        wardSelect.appendChild(option);
                    });

                    // Nếu đã có xã/phường cũ được chọn (old value)
                    const oldWardId = "{{ old('ward_id', $companyInfo->address->ward_id ?? '') }}";
                    if (oldWardId) {
                        wardSelect.value = oldWardId;
                    }
                } catch (error) {
                    console.error('Error fetching wards:', error);
                }
            }
        }

        // Khi trang được tải, gọi fetchDistricts để đảm bảo các quận và xã/phường được hiển thị đúng
        window.onload = fetchDistricts;

    </script>
    <script>
        document.getElementById('avatarInput').addEventListener('change', function (event) {
            const formData = new FormData();
            const fileInput = event.target;
            const avatarImage = document.getElementById('uploadedImage');

            if (fileInput.files.length > 0) {
                formData.append('avatar_path', fileInput.files[0]);

                fetch(`{{route('company.profileUpdateAvatar', ['slug' => $companyInfo->slug ?? $userID]) }}`, {
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
                                icon: "error",
                                title: "Có lỗi xảy ra!"
                            });
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
