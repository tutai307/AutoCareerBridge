@extends('management.layout.main')

@section('title', 'Cập nhật thông tin doanh nghiệp')

@section('content')
    <div class="container-fluid">
        <form
            action="{{route('company.profileUpdate', ['slug' => $companyInfo->slug ?? $user->id])}}"
            method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix" style="position:sticky; top: 50px">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-body">
                                <div class="avatar-upload text-center">
                                    <div class="position-relative">
                                        <div class="avatar-preview">
                                            @php
                                                $avatar_path = isset($companyInfo) && isset($companyInfo->avatar_path) ? $companyInfo->avatar_path : asset('management-assets/images/no-img-avatar.png');
                                            @endphp
                                            <div id="imagePreview"
                                                 style="background-image: url({{$avatar_path}}); width: 100%; height: 220px; background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 8px; image-rendering: crisp-edges;">
                                            </div>
                                        </div>
                                        <div class="change-btn mt-2">
                                            <input type="file" class="form-control d-none" id="imageUpload"
                                                   name="avatar_path" accept=".png, .jpg, .jpeg">

                                            <label for="imageUpload"
                                                   class="btn btn-primary light btn-sm">{{ __('label.company.hiring.add.choose') }}</label>
                                        </div>
                                        @error('avatar_path')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
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
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tên công ty -->
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.name') }}</label>
                                    <input type="text" name="name" id="name" oninput="ChangeToSlug()"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{__('label.admin.profile.placeholder_name')}}"
                                           value="{{ old('name', $companyInfo->name ?? '') }}"/>
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.slug') }}</label>
                                    <input type="text" name="slug" id="slug"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           placeholder="{{ __('label.admin.profile.placeholder_name') }}"
                                           value="{{ old('slug', $companyInfo->slug ?? '') }}"/>
                                    @error('slug')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                    class="col-sm-6 m-b30 {{ isset($companyInfo->phone) && $companyInfo->phone ? 'd-none' : '' }}">
                                    <label
                                        class="form-label required">{{ __('label.admin.profile.phone') }} </label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone"
                                           value="{{ old('phone', $companyInfo->phone ?? '') }}"
                                           placeholder="012345678"/>
                                    @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.size') }} </label>
                                    <input type="number" class="form-control @error('size') is-invalid @enderror"
                                           name="size"
                                           value="{{old('size', $companyInfo->size ?? '') }}"
                                           placeholder="{{ __('label.admin.profile.placeholder_size') }}"/>
                                    @error('size')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label ">{{ __('label.admin.profile.web_link') }}: </label>
                                    <input type="text" class="form-control" name="website_link"
                                           value="{{old('website_link', $companyInfo->website_link ?? '') }}"
                                           placeholder="{{ __('label.admin.profile.placeholder_website') }}"/>
                                    @error('website_link')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.field') }}
                                        : </label>
                                    <select id="field-select"
                                            class="single-select form-select @error('fields') is-invalid @enderror"
                                            style="width:100%;" name="fields[]" multiple>
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
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <h5> {{ __('label.admin.profile.address') }} </h5>
                                <div class="col-sm-6 m-b30">
                                    <label class="form-label d-block required" for="province-select">
                                        {{ __('label.admin.profile.province') }}
                                    </label>
                                    <select id="province-select"
                                            class="form-select single-select @error('province_id') is-invalid @enderror"
                                            style="width:100%;"
                                            name="province_id">
                                        <option
                                            value="">{{ __('label.admin.profile.placeholder_province') }}</option>
                                        @foreach($companyInfo->provinces ?? [] as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id', $companyInfo->address?->province_id ?? '') == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-sm-6">
                                    <label class="form-label d-block required" for="district-select">
                                        {{ __('label.admin.profile.district') }}
                                    </label>
                                    <select name="district_id"
                                            class="single-select form-select @error('district_id') is-invalid @enderror"
                                            id="district-select"
                                            style="width:100%;"
                                            onchange="fetchWards()">
                                        <option
                                            value="">{{ __('label.admin.profile.placeholder_district') }}</option>
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
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label d-block required" for="ward-select">
                                        {{ __('label.admin.profile.ward') }}
                                    </label>
                                    <select name="ward_id"
                                            class="single-select form-select @error('ward_id') is-invalid @enderror"
                                            id="ward-select">
                                        <option value="">{{ __('label.admin.profile.placeholder_ward') }}</option>
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
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label d-block required" for="specific-select">
                                        {{ __('label.admin.profile.specific_address') }}
                                    </label>
                                    <input type="text"
                                           name="specific_address"
                                           class="form-control @error('specific_address') is-invalid @enderror"
                                           id="specific-select"
                                           value="{{ old('specific_address', $companyInfo->address->specific_address ?? '') }}"
                                           placeholder="{{ __('label.admin.profile.placeholder_address_detail') }}">
                                    @error('specific_address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Mô tả công ty -->
                                <div class="col-12 m-b30 mt-3">
                                    <label class="form-label">{{ __('label.admin.profile.description') }}</label>
                                    <textarea id="content_1" name="description"
                                              class="form-control tinymce_editor_init"
                                              rows=""> {{ old('description', $companyInfo->description ?? '') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Giới thiệu về công ty -->
                                <div class="col-12 m-b30">
                                    <label class="form-label required">{{ __('label.admin.profile.about') }}</label>
                                    <textarea id="content_2" name="about"
                                              class="form-control tinymce_editor_init @error('about') is-invalid @enderror"
                                              rows="">{{ old('about', $companyInfo->about ?? '') }}</textarea>
                                    @error('about')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit"
                                    class="btn btn-primary">{{ __('label.admin.profile.submit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('css')
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").on('change', function () {
            readURL(this);
        });
    </script>
    <script>
        $(document).ready(function () {
            const oldProvinceId = "{{ old('province_id', $companyInfo->address?->province_id ?? '') }}";
            const oldDistrictId = "{{ old('district_id', $companyInfo->address?->district_id ?? '') }}";
            const oldWardId = "{{ old('ward_id', $companyInfo->address?->ward_id ?? '') }}";

            if (oldProvinceId) {
                $('#province-select').val(oldProvinceId).trigger('change');

                if (oldDistrictId) {
                    fetchDistricts(oldProvinceId, function () {
                        $('#district-select').val(oldDistrictId).trigger('change');

                        if (oldWardId) {
                            fetchWards(oldDistrictId, function () {
                                $('#ward-select').val(oldWardId);
                            });
                        }
                    });
                }
            }
        });
    </script>
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
                    $provinceSelect.append('<option value="">{{ __('label.admin.profile.placeholder_province') }}</option>');

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

            $districtSelect.empty().append('<option value="">{{ __('label.admin.profile.placeholder_district') }}</option>');
            $wardSelect.empty().append('<option value="">{{ __('label.admin.profile.placeholder_ward') }}</option>');
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

                        // Gán giá trị mặc định
                        const oldDistrictId = "{{ old('district_id', $companyInfo->address?->district_id ?? '') }}";
                        if (oldDistrictId) {
                            $districtSelect.val(oldDistrictId).change();
                            $districtSelect.selectpicker('refresh');
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
            $wardSelect.empty().append('<option value="">{{ __('label.admin.profile.placeholder_ward') }}</option>');
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

                        // Gán giá trị mặc định
                        const oldWardId = "{{ old('ward_id', $companyInfo->address?->ward_id ?? '') }}";
                        if (oldWardId) {
                            $wardSelect.val(oldWardId);
                            $wardSelect.selectpicker('refresh');
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

            // Gán giá trị mặc định cho special address
            const oldSpecialAddress = "{{ old('special_address', $companyInfo->address?->special_address ?? '') }}";
            if (oldSpecialAddress) {
                $('#special-select').val(oldSpecialAddress);
            }
        });
    </script>
@endsection
