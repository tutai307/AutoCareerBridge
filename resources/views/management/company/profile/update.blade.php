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
                                <a href="{{ route('companyProfile') }}">Hồ sơ doanh nghiệp</a>
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
{{--                                    <form action="{{ route('companyProfile.updateAvatar') }}" method="post">--}}
                                        <div class="author-media">
                                            <img
                                                src="{{ $companyInfo->avatar_path ? asset('storage/'.$companyInfo->avatar_path) : asset('management-assets/images/user.jpg') }}"
                                                alt=""/>
                                            <div class="upload-link" title="" data-toggle="tooltip" data-placement="right"
                                                 data-original-title="update">
                                                <input type="file" class="update-flie" name="avatar_path"/>
                                                <i class="fa fa-camera"></i>
                                            </div>
                                        </div>
{{--                                    </form>--}}
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
                    <form action="{{ route('companyProfileUpdate',['slug' => $companyInfo->slug]) }}" method="post" enctype="multipart/form-data">
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
                                            id="province-select" >
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id', $address->province_id) == $province->id ? 'selected' : '' }}>
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
                                            id="district-select" >
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('district_id', $address->district_id) == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}
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
                                            id="ward-select"  >
                                        @foreach($wards as $ward)
                                            <option value="{{ $ward->id }}"
                                                {{ old('ward_id', $address->ward_id) == $ward->id ? 'selected' : '' }}>
                                                {{ $ward->name }}
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
                                           value="{{ old('specific_address', $address->specific_address) }}"
                                           placeholder="Nhập số nhà, tên đường..."
                                           minlength="5"
                                           maxlength="255">
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
        $(document).ready(function() {
            $('#province-select').on('change', function() {
                var province_id = $(this).val();
                $('#specific-select').val(''); // Xóa trắng địa chỉ chi tiết

                if(province_id) {
                    $.ajax({
                        url: "{{ url('/districts') }}/" + province_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#district-select').empty();
                            $('#ward-select').empty(); // Xóa xã/phường khi thay đổi tỉnh
                            $('#district-select').append('<option value="">Chọn quận/huyện</option>');
                            $.each(data, function(key, value) {
                                $('#district-select').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#district-select').empty();
                    $('#ward-select').empty();
                }
            });

            $('#district-select').on('change', function() {
                var district_id = $(this).val();
                $('#specific-select').val(''); // Xóa trắng địa chỉ chi tiết

                if(district_id) {
                    $.ajax({
                        url: "{{ url('/wards') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#ward-select').empty();
                            $('#ward-select').append('<option value="">Chọn xã/phường</option>');
                            $.each(data, function(key, value) {
                                $('#ward-select').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                } else {
                    $('#ward-select').empty();
                }
            });

            $('#ward-select').on('change', function() {
                $('#specific-select').val(''); // Xóa trắng địa chỉ chi tiết khi thay đổi xã/phường
            });
        });
    </script>

@endsection
