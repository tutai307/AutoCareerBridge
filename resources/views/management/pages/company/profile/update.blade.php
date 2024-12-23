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
                                                $avatar_path = isset($companyInfo) && isset($companyInfo->avatar_path) ? asset($companyInfo->avatar_path) : asset('management-assets/images/no-img-avatar.png');
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
                                                <p>{{ $companyInfo->phone ?? ''}}</p>

                                            @endif
                                        </li>
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
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <div class="form-control rounded text-center">
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
                                    <label class="form-label required">{{ __('label.admin.profile.field') }}:</label>
                                    <select id="field-select"
                                            class="single-select bootstrap-select @error('fields') is-invalid @enderror"
                                            style="width:100%;" name="fields[]" multiple>
                                        <option disabled selected>Chọn lĩnh vực</option>
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
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label d-block required" for="province-select">
                                        {{ __('label.admin.profile.province') }}
                                    </label>
                                    <select id="province-select"
                                            name="province_id"
                                            class="bootstrap-select single-select @error('province_id') is-invalid @enderror"
                                            style="width:100%;">
                                        <option value="">{{ __('label.admin.profile.placeholder_province') }}</option>
                                    </select>
                                    @error('province_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-4">
                                    <label class="form-label d-block required" for="district-select">
                                        {{ __('label.admin.profile.district') }}
                                    </label>
                                    <select id="district-select"
                                            name="district_id"
                                            class="bootstrap-select single-select @error('district_id') is-invalid @enderror"
                                            style="width:100%;">
                                        <option value="">{{ __('label.admin.profile.placeholder_district') }}</option>
                                    </select>
                                    @error('district_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-4">
                                    <label class="form-label d-block required" for="ward-select">
                                        {{ __('label.admin.profile.ward') }}
                                    </label>
                                    <select id="ward-select"
                                            name="ward_id"
                                            class="bootstrap-select single-select @error('ward_id') is-invalid @enderror"
                                            style="width:100%;">
                                        <option value="">{{ __('label.admin.profile.placeholder_ward') }}</option>
                                    </select>
                                    @error('ward_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-4">
                                    <label class="form-label d-block required" for="specific-select">
                                        {{ __('label.admin.profile.specific_address') }}
                                    </label>
                                    <input type="text"
                                           id="specific-select"
                                           name="specific_address"
                                           class="form-control @error('specific_address') is-invalid @enderror"
                                           placeholder="{{ __('label.admin.profile.placeholder_address_detail') }}"
                                           value="{{ old('specific_address', $companyInfo->address?->specific_address ?? '') }}">
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
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">{{ __('label.admin.profile.submit') }}</button>
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
        $(document).ready(function () {
            // Store old values in constants
            const OLD_VALUES = {
                province: "{{ old('province_id', $companyInfo->address?->province_id ?? '') }}",
                district: "{{ old('district_id', $companyInfo->address?->district_id ?? '') }}",
                ward: "{{ old('ward_id', $companyInfo->address?->ward_id ?? '') }}",
                specificAddress: "{{ old('specific_address', $companyInfo->address?->specific_address ?? '') }}"
            };

            // Store placeholders
            const PLACEHOLDERS = {
                province: "{{ __('label.admin.profile.placeholder_province') }}",
                district: "{{ __('label.admin.profile.placeholder_district') }}",
                ward: "{{ __('label.admin.profile.placeholder_ward') }}"
            };

            // Initial load
            loadInitialData();

            // Event listeners
            $('#province-select').on('change', handleProvinceChange);
            $('#district-select').on('change', handleDistrictChange);
            $('#ward-select').on('change', handleWardChange);

            function loadInitialData() {
                // Load provinces first
                fetchProvinces(() => {
                    if (OLD_VALUES.province) {
                        $('#province-select').val(OLD_VALUES.province);
                        $('#province-select').selectpicker('refresh');

                        // Load districts if province exists
                        fetchDistricts(OLD_VALUES.province, () => {
                            if (OLD_VALUES.district) {
                                $('#district-select').val(OLD_VALUES.district);
                                $('#district-select').selectpicker('refresh');

                                // Load wards if district exists
                                fetchWards(OLD_VALUES.district, () => {
                                    if (OLD_VALUES.ward) {
                                        $('#ward-select').val(OLD_VALUES.ward);
                                        $('#ward-select').selectpicker('refresh');
                                    }
                                });
                            }
                        });
                    }
                });

                // Set specific address if exists
                if (OLD_VALUES.specificAddress) {
                    $('#specific-select').val(OLD_VALUES.specificAddress);
                }
            }

            function fetchProvinces(callback) {
                $.ajax({
                    url: '/api/provinces',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const $select = $('#province-select');
                        $select.empty()
                            .append(`<option value="">${PLACEHOLDERS.province}</option>`);

                        data.forEach(province => {
                            $select.append(`<option value="${province.id}">${province.name}</option>`);
                        });

                        $select.selectpicker('refresh');
                        if (callback) callback();
                    },
                    error: function (error) {
                        console.error('Error fetching provinces:', error);
                    }
                });
            }

            function fetchDistricts(provinceId, callback) {
                if (!provinceId) return;

                const $select = $('#district-select');
                $select.empty()
                    .append(`<option value="">${PLACEHOLDERS.district}</option>`);

                // Reset ward and specific address when loading new districts
                resetWardAndAddress();

                $.ajax({
                    url: `/api/districts/${provinceId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(district => {
                            $select.append(`<option value="${district.id}">${district.name}</option>`);
                        });

                        $select.selectpicker('refresh');
                        if (callback) callback();
                    },
                    error: function (error) {
                        console.error('Error fetching districts:', error);
                    }
                });
            }

            function fetchWards(districtId, callback) {
                if (!districtId) return;

                const $select = $('#ward-select');
                $select.empty()
                    .append(`<option value="">${PLACEHOLDERS.ward}</option>`);

                $.ajax({
                    url: `/api/wards/${districtId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(ward => {
                            $select.append(`<option value="${ward.id}">${ward.name}</option>`);
                        });

                        $select.selectpicker('refresh');
                        if (callback) callback();
                    },
                    error: function (error) {
                        console.error('Error fetching wards:', error);
                    }
                });
            }

            function resetWardAndAddress() {
                // Only reset ward
                const $wardSelect = $('#ward-select');
                $wardSelect.empty()
                    .append(`<option value="">${PLACEHOLDERS.ward}</option>`)
                    .selectpicker('refresh');

                // Don't reset specific address if it has old value
                if (!OLD_VALUES.specificAddress) {
                    $('#specific-select').val('');
                }
            }

            function handleProvinceChange() {
                const provinceId = $(this).val();
                if (provinceId) {
                    fetchDistricts(provinceId);
                } else {
                    // Reset both district and ward if province is cleared
                    $('#district-select').empty()
                        .append(`<option value="">${PLACEHOLDERS.district}</option>`)
                        .selectpicker('refresh');
                    $('#ward-select').empty()
                        .append(`<option value="">${PLACEHOLDERS.ward}</option>`)
                        .selectpicker('refresh');
                }
            }

            function handleDistrictChange() {
                const districtId = $(this).val();
                if (districtId) {
                    fetchWards(districtId);
                } else {
                    // Reset ward if district is cleared
                    $('#ward-select').empty()
                        .append(`<option value="">${PLACEHOLDERS.ward}</option>`)
                        .selectpicker('refresh');
                }
            }

            function handleWardChange() {
                // Only reset specific address if no old value exists
                if (!OLD_VALUES.specificAddress) {
                    $('#specific-select').val('');
                }
            }
        });
    </script>
@endsection
