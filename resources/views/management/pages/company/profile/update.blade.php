@extends('management.layout.main')

@section('title', 'Cập nhật thông tin doanh nghiệp')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('label.breadcrumb.home') }}</a></li>
                            <li class="breadcrumb-item " aria-current="page">
                                <a href="{{ route('company.profile', ['slug' => $companyInfo->slug ?? 'no-slug']) }}">{{ __('label.breadcrumb.profile') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('label.admin.profile.information_detail') }}
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
                                        action="{{ route('company.profileUpdateAvatar', ['slug' => $companyInfo->slug ?? $user->id]) }}"
                                        method="post" enctype="multipart/form-data" id="updateImageForm">
                                        @method('PATCH')
                                        @csrf
                                        <div class="author-media">
                                            <img id="uploadedImage"
                                                 src="{{isset($companyInfo->avatar_path) ? asset($companyInfo->avatar_path) : asset('management-assets/images/user.jpg') }}"
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
                                        <span>{{ __('label.admin.company') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <p>{{ __('label.admin.profile.join_date') }}: </p>
                                        <p>
                                            @if (isset($companyInfo->created_at))
                                                {{ date_format($companyInfo->created_at, 'd/m/Y')}}

                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p>{{ __('label.admin.profile.last_updated') }}: </p>
                                        <p>@if (isset($companyInfo->updated_at))
                                                {{ date_format($companyInfo->updated_at, 'd/m/Y')}}

                                            @endif</p>
                                    </li>
                                    <li>
                                        <p>{{ __('label.admin.profile.size') }}: </p>
                                        <p>
                                            @if (isset($companyInfo->size))
                                                {{ $companyInfo->size ?? '' }} {{ __('label.admin.profile.member') }}

                                            @endif
                                        </p>
                                    </li>
                                    <li>
                                        <p>{{ __('label.admin.profile.phone') }}: </p>
                                        @if (isset($companyInfo->phone))
                                            <span>{{ $companyInfo->phone ?? ''}}</span>

                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="form-control rounded text-center mb-3">
                                    {{ $companyInfo->user->email ?? $user->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card profile-card card-bx m-b30">
                    <div class="card-header">
                        <h6 class="card-title">{{ __('label.breadcrumb.update_profile') }}</h6>
                    </div>
                    <form
                        action="{{route('company.profileUpdate', ['slug' => $companyInfo->slug ?? $user->id])}}"
                        method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tên công ty -->
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.name') }}</label>
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
                                    <label class="form-label required">{{ __('label.admin.profile.slug') }}</label>
                                    <input type="text" name="slug" id="slug"
                                           class="form-control"
                                           placeholder="to-chuc-xa-hoi-trang-duy-lap"
                                           value="{{ old('slug', $companyInfo->slug ?? '') }}"/>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                    class="col-sm-6 m-b30 {{ isset($companyInfo->phone) && $companyInfo->phone ? 'd-none' : '' }}">
                                    <label class="form-label required">{{ __('label.admin.profile.phone') }} </label>
                                    <input type="number" class="form-control" name="phone"
                                           value="{{ old('phone', $companyInfo->phone ?? '') }}"
                                           placeholder="012345678"/>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.size') }} </label>
                                    <input type="number" class="form-control" name="size"
                                           value="{{old('size', $companyInfo->size ?? '') }}" placeholder="300"/>
                                    @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label ">{{ __('label.admin.profile.web_link') }}: </label>
                                    <input type="text" class="form-control" name="website_link"
                                           value="{{old('website_link', $companyInfo->website_link ?? '') }}"
                                           placeholder="https://"/>
                                    @error('website_link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label">{{ __('label.admin.profile.field') }}: </label>
                                    <select id="field-select" class="single-select" style="width:100%;" name="fields[]" multiple>
                                        @foreach($companyInfo->allFields as $field)
                                            <option value="{{ $field->id }}"
                                                {{ in_array($field->id, old('fields',
                                                    $companyInfo->fields ? $companyInfo->fields->pluck('id')->toArray() : []
                                                )) ? 'selected' : '' }}>
                                                {{ $field->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fields')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <h5> {{ __('label.admin.profile.address') }} </h5>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block required" for="province-select">
                                        {{ __('label.admin.profile.province') }}
                                    </label>
                                    <select id="province-select" class="single-select" style="width:100%;"
                                            name="province_id">
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
                                        {{ __('label.admin.profile.district') }}
                                    </label>
                                    <select name="district_id" class="single-select" id="district-select"
                                            style="width:100%;"
                                            onchange="fetchWards()">
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
                                        {{ __('label.admin.profile.ward') }}
                                    </label>
                                    <select name="ward_id" class="single-select" id="ward-select">
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
                                        {{ __('label.admin.profile.address_detail') }}
                                    </label>
                                    <input type="text" name="specific_address" class="form-control" id="specific-select"
                                           value="{{ old('specific_address', $companyInfo->address->specific_address ?? '') }}"
                                           placeholder="Nhập số nhà, tên đường..." minlength="5" maxlength="255">
                                    @error('specific_address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mô tả công ty -->
                                <div class="col-12 m-b30 mt-3">
                                    <label class="form-label">{{ __('label.admin.profile.description') }}</label>
                                    <textarea id="content_1" name="description" class="form-control tinymce_editor_init"
                                              rows=""> {{ old('description', $companyInfo->description ?? '') }}</textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Giới thiệu về công ty -->
                                <div class="col-12 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.about') }}</label>
                                    <textarea id="content_2" name="about" class="form-control tinymce_editor_init"
                                              rows="">{{ old('about', $companyInfo->about ?? '') }}</textarea>
                                    @error('about')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit"
                                    class="btn btn-primary">{{ __('label.admin.profile.submit') }}</button>
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
            const currentProvinceId = $('#province-select').val();

            $.ajax({
                url: '/api/provinces',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const $provinceSelect = $('#province-select');
                    $provinceSelect.empty(); // Xóa tất cả các option cũ
                    $provinceSelect.append('<option value="">Chọn Tỉnh/Thành phố</option>');

                    data.forEach(province => {
                        const selected = province.id == currentProvinceId ? 'selected' : '';
                        $provinceSelect.append(`<option value="${province.id}" ${selected}>${province.name}</option>`);
                    });

                    $provinceSelect.selectpicker('refresh');
                },
                error: function (error) {
                    console.error('Lỗi khi lấy danh sách tỉnh/thành phố:', error);
                }
            });
        }

        function reloadProvinces() {
            fetchProvinces();
        }

        function resetSpecificAddress() {
            $('#specific-select').val('');
        }

        function fetchDistricts() {
            const provinceId = $('#province-select').val();

            const $districtSelect = $('#district-select');
            const $wardSelect = $('#ward-select');

            $districtSelect.empty().append('<option value="">Chọn Quận/Huyện</option>');
            $wardSelect.empty().append('<option value="">Chọn Xã/Phường</option>');
            resetSpecificAddress();

            if (provinceId) {
                $.ajax({
                    url: `/api/districts/${provinceId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (districts) {
                        districts.forEach(district => {
                            $districtSelect.append(`<option value="${district.id}">${district.name}</option>`);
                        });

                        $districtSelect.selectpicker('refresh');

                        const oldDistrictId = "{{ $companyInfo->address->district_id ?? '' }}";
                        if (oldDistrictId) {
                            $districtSelect.val(oldDistrictId);
                            $districtSelect.selectpicker('refresh');
                            fetchWards();
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching districts:', error);
                    }
                });
            }
        }

        function fetchWards() {
            const districtId = $('#district-select').val();

            const $wardSelect = $('#ward-select');
            $wardSelect.empty().append('<option value="">Chọn Xã/Phường</option>');
            resetSpecificAddress();

            if (districtId) {
                $.ajax({
                    url: `/api/wards/${districtId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (wards) {
                        wards.forEach(ward => {
                            $wardSelect.append(`<option value="${ward.id}">${ward.name}</option>`);
                        });

                        $wardSelect.selectpicker('refresh');

                        const oldWardId = "{{ $companyInfo->address->ward_id ?? '' }}";
                        if (oldWardId) {
                            $wardSelect.val(oldWardId);
                            $wardSelect.selectpicker('zrefresh');
                        }
                    },
                    error: function (error) {
                        console.error('Error fetching wards:', error);
                    }
                });
            }
        }

        $(document).ready(function () {
            fetchProvinces();

            $('#province-select').on('change', function () {
                resetSpecificAddress();
                fetchDistricts();
            });

            $('#district-select').on('change', function () {
                resetSpecificAddress();
                fetchWards();
            });

            $('#ward-select').on('change', function () {
                resetSpecificAddress();
            });
        });


    </script>
    <script>
        document.getElementById('avatarInput').addEventListener('change', function (event) {
                const formData = new FormData();
                const fileInput = event.target;
                const avatarImage = document.getElementById('uploadedImage');

                if (fileInput.files.length > 0) {
                    formData.append('avatar_path', fileInput.files[0]);

                    fetch(`{{route('company.profileUpdateAvatar', ['slug' => $companyInfo->slug ?? $user->id]) }}`, {
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
                                // Thêm tham số ngẫu nhiên vào URL của ảnh để tránh cache
                                avatarImage.src = `${data.imageUrl}?t=${new Date().getTime()}`;

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
                                    title: "Vui lòng cập nhật thông tin"
                                });
                            }
                        })

                }
            }
        );
    </script>
@endsection
