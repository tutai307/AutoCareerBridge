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
                                    <label class="form-label">Tên:</label>
                                    <input type="text" name="name" id="name" oninput="ChangeToSlug()" class="form-control"
                                           placeholder="Tổ chức xã hội trắng Duy Lập"
                                           value="{{ old('name', $companyInfo->name) }}"/>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Slug:</label>
                                    <input type="text" name="slug" id="slug" oninput="ChangeToSlug()" class="form-control"
                                           placeholder="to-chuc-xa-hoi-trang-duy-lap"
                                           value=" {{ old('slug',$companyInfo->slug) }}"/>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Số điện thoại: </label>
                                    <input type="number" class="form-control" name="phone"
                                           value="{{ old('phone',$companyInfo->phone) }}"
                                           placeholder="012345678"/>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">Quy mô: </label>
                                    <input type="number" class="form-control" name="size"
                                           value="{{old('size', $companyInfo->size) }}"
                                           placeholder="300"/>
                                    @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <h5> Địa chỉ: </h5>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="province-select">Tỉnh/Thành phố<span class="text-danger">*</span></label>
                                    <select name="province_id" class="form-control default-select h-auto wide"
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
                                    <label class="form-label d-block" for="district-select">Quận/Huyện<span class="text-danger">*</span></label>
                                    <select name="district_id" class="form-control default-select h-auto wide"
                                            id="district-select" onchange="fetchWards()" disabled>
                                        <option value="">Chọn Quận/Huyện</option>
                                        @foreach($companyInfo->districts as $district)
                                            <option value="{{ $district['id'] }}"
                                                {{ old('district_id', $companyInfo->address->district_id) == $district['id'] ? 'selected' : '' }}>
                                                {{ $district['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="ward-select">Xã/Phường<span class="text-danger">*</span></label>
                                    <select name="ward_id" class="form-control default-select h-auto wide"
                                            id="ward-select" disabled>
                                        <option value="">Chọn Xã/Phường</option>
                                        @foreach($companyInfo->wards as $ward)
                                            <option value="{{ $ward['id'] }}"
                                                {{ old('ward_id', $companyInfo->address->ward_id) == $ward['id'] ? 'selected' : '' }}>
                                                {{ $ward['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ward_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block" for="specific-select">Địa chỉ chi tiết<span class="text-danger">*</span></label>
                                    <input type="text" name="specific_address" class="form-control" id="specific-select"
                                           value="{{ old('specific_address', $companyInfo->address->specific_address) }}"
                                           placeholder="Nhập số nhà, tên đường..."
                                           minlength="5"
                                           maxlength="255" disabled>
                                    @error('specific_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 m-b30">
                                    <label class="form-label d-block">Map</label>
                                    <textarea class="form-control"
                                              name="map"> {{ old('map' ,$companyInfo->map) }}</textarea>
                                    @error('map')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label d-block">Mô tả</label>
                                    <textarea class="form-control"
                                              name="description"> {{ old('description', $companyInfo->description) }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label d-block">Giới thiệu</label>
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
        async function fetchDistricts() {
            const provinceId = document.getElementById('province-select').value;
            if (!provinceId) return; // Exit if no province is selected

            // Enable district select
            document.getElementById('district-select').disabled = false;

            try {
                const response = await fetch(`/districts/${provinceId}`);
                const districts = await response.json();

                const districtSelect = document.getElementById('district-select');
                districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>'; // Reset options

                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.text = district.name;
                    districtSelect.appendChild(option);
                });

                // Clear wards select when province changes
                document.getElementById('ward-select').innerHTML = '<option value="">Chọn Xã/Phường</option>';
                document.getElementById('ward-select').disabled = true; // Disable ward select

                // Disable the detailed address input until a ward is selected
                document.getElementById('specific-select').disabled = true;

            } catch (error) {
                console.error('Error fetching districts:', error);
            }
        }

        async function fetchWards() {
            const districtId = document.getElementById('district-select').value;
            if (!districtId) return; // Exit if no district is selected

            // Enable ward select
            document.getElementById('ward-select').disabled = false;

            try {
                const response = await fetch(`/wards/${districtId}`);
                const wards = await response.json();

                const wardSelect = document.getElementById('ward-select');
                wardSelect.innerHTML = '<option value="">Chọn Xã/Phường</option>'; // Reset options

                wards.forEach(ward => {
                    const option = document.createElement('option');
                    option.value = ward.id;
                    option.text = ward.name;
                    wardSelect.appendChild(option);
                });

                // Enable detailed address input when ward is selected
                document.getElementById('specific-select').disabled = false;

            } catch (error) {
                console.error('Error fetching wards:', error);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const provinceId = document.getElementById('province-select').value;
            if (provinceId) {
                fetchDistricts(); // Load districts if province is selected
            }

            const districtId = document.getElementById('district-select').value;
            if (districtId) {
                fetchWards(); // Load wards if district is selected
            }
        });
    </script>
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
