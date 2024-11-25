@extends('management.layout.main')

@section('title', __('label.admin.management_university.workshop.add_workshop'))

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('university.workshop.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider:'>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('university.workshop.index') }}">{{ __('label.admin.management_university.workshop.title') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.admin.management_university.workshop.add_workshop') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">{{ __('label.admin.management_university.workshop.detail_workshop') }}
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <label
                                        class="form-label required">{{ __('label.admin.management_university.workshop.name') }}</label>
                                    <input type="text" id="name" oninput="ChangeToSlug()"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Tên workshop"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label
                                        class="form-label required">{{ __('label.admin.management_university.workshop.slug') }}</label>
                                    <input type="text" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" name="slug"
                                        value="{{ old('slug') }}" readonly placeholder="Slug">
                                    @error('slug')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="content"
                                        class="form-label required">{{ __('label.admin.management_university.workshop.content') }}
                                    </label>
                                    <textarea name="content" id="content" class="form-control tinymce_editor_init @error('content') is-invalid @enderror"
                                        cols="40" rows="10">{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('university.workshop.index') }}"
                                class="btn btn-light">{{ __('label.admin.back') }}</a>
                            <button class="btn btn-primary" type="submit">{{ __('label.admin.add_new') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title">
                                    {{ __('label.admin.management_university.workshop.information_workshop') }}
                                </h6>
                            </div>
                            <div class="card-footer">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label
                                            class="form-label required">{{ __('label.admin.management_university.workshop.start_date') }}</label>
                                        <input type="text"
                                            class="form-control date-format @error('start_date') is-invalid @enderror"
                                            name="start_date" value="{{ old('start_date') }}"
                                            placeholder="Nhấn để chọn thời gian">

                                        @error('start_date')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label
                                            class="form-label required">{{ __('label.admin.management_university.workshop.end_date') }}</label>
                                        <input type="text"
                                            class="form-control date-format @error('end_date') is-invalid @enderror"
                                            name="end_date" value="{{ old('end_date') }}"
                                            placeholder="Nhấn để chọn thời gian">
                                        @error('end_date')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label for="amount"
                                            class="form-label required">{{ __('label.admin.management_university.workshop.amount') }}
                                        </label>
                                        <input type="number" id="amount"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="Số lượng" name="amount" value="{{ old('amount') }}"
                                            min="1">
                                        @error('amount')
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
                                <h6 class="card-title required">
                                    {{ __('label.admin.management_university.workshop.avatar') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="card-body d-flex justify-content-center">
                                    <div class="avatar-upload text-center">
                                        <div class="position-relative">
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url({{ asset('management-assets/images/no-img-avatar.png') }}); width: 271px; height: 220px;">
                                                </div>
                                            </div>
                                            <div class="change-btn mt-2">
                                                <input type='file' class="form-control d-none" id="imageUpload"
                                                    name="avatar_path" accept=".png, .jpg, .jpeg, .gif, .webp">
                                                <label for="imageUpload"
                                                    class="btn btn-primary light btn-sm">{{ __('label.admin.management_university.workshop.select_avatar') }}</label>
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
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/vi.min.js"></script>

    <script
        src="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>
    <script src="{{ asset('management-assets') }}/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
    <script src="{{ asset('management-assets') }}/js/plugins-init/material-date-picker-init.js"></script>
    <script src="{{ asset('management-assets') }}/js/plugins-init/pickadate-init.js"></script>

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
@endsection
