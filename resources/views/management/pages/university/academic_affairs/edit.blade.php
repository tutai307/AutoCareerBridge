@extends('management.layout.main')

@section('title', 'Cập nhật giáo vụ')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('university.updateAcademicAffairs', $academicAffairs->user_id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('university.academicAffairs') }}">{{ __('label.university.academic.add.company') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('label.university.academic.edit.update_employee') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title">{{ __('label.university.academic.edit.profile_employee') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label required">{{ __('label.university.academic.edit.name') }}</label>
                                        <input type="text" id="name"
                                            class="form-control @error('full_name') is-invalid @enderror"
                                            placeholder="{{ __('label.university.academic.edit.name') }}" name="full_name" value="{{ $academicAffairs->name }}">
                                        @error('full_name')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label required">{{ __('label.university.academic.edit.phone') }}</label>
                                        <input type="text" id="student_code"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Số điện thoại" name="phone"
                                            value="{{ $academicAffairs->phone }}" oninput="validateNumberInput(event)">
                                        @error('phone')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title">{{ __('label.university.academic.edit.image_employee') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="card-body d-flex justify-content-center">
                                    <div class="avatar-upload text-center">
                                        <div class="position-relative">
                                            <div class="avatar-preview">
                                                <div id="imagePreview"

                                                    style="background-image: url('{{ asset($academicAffairs['avatar_path'] ? 'storage/' . $academicAffairs['avatar_path'] : 'management-assets/images/no-img-avatar.png') }}'); width: 271px; height: 220px; background-size: contain; background-repeat: no-repeat; background-position: center;">


                                                </div>
                                            </div>
                                            <div class="change-btn mt-2">
                                                <input type='file' class="form-control d-none" id="imageUpload"
                                                    name="avatar_path" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload" class="btn btn-primary light btn-sm">{{ __('label.university.academic.edit.choose') }}</label>
                                            </div>
                                            @error('avatar_path')
                                                <span class="d-block text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">{{ __('label.university.academic.edit.information_details') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 m-b30 cm-content-body form excerpt">
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">{{ __('label.university.academic.edit.user_name') }} <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('label.university.academic.edit.user_name') }}"
                                        value="{{ $academicAffairs->user->user_name }}" disabled>

                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">Email <span class="text-danger"></span></label>
                                    <input type="email" class="form-control" placeholder="example@gmail.com"
                                        value="{{ $academicAffairs->user->email }}" disabled>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('university.academicAffairs') }}" class="btn btn-light">Quay lại</a>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        //Ảnh
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").on('change', function() {
            readURL(this);
        });
    </script>
    <script>
        function validateNumberInput(event) {
            const inputValue = event.target.value;
            event.target.value = inputValue.replace(/[^0-9]/g, '');
        }
    </script>
@endsection
