@extends('management.layout.main')

@section('title', __('label.university.student.edit_student'))

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('university.students.update', $student['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('university.students.index') }}">{{ __('label.university.student.title') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.university.student.edit_student') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title">{{ __('label.university.student.information_student') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">{{ __('label.university.student.name') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="name"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', $student['name']) }}">
                                        @error('name')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label required">{{ __('label.university.student.student_code') }}</label>
                                        <input type="text" id="student_code"
                                            class="form-control @error('student_code') is-invalid @enderror"
                                            name="student_code" value="{{ old('student_code', $student['student_code']) }}">
                                        @error('student_code')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="slug"
                                    class="form-control @error('slug') is-invalid @enderror" name="slug"
                                    value="{{ old('slug', $student['slug']) }}">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">{{ __('label.company.job.skill') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="multi-value-select" multiple="multiple" name="skill_name[]">
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->name }}" {{ in_array($skill->id, $student->skills->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $skill->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('skill_name')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                        @error('skill_name.*')
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
                                <h6 class="card-title">{{ __('label.university.student.avatar') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="card-body d-flex justify-content-center">
                                    <div class="avatar-upload text-center">
                                        <div class="position-relative">
                                            <div class="avatar-preview">
                                                <div id="imagePreview"
                                                    style="background-image: url({{ $student['avatar_path'] ? asset('storage/' . $student['avatar_path']) : asset('management-assets/images/no-img-avatar.png') }}); width: 271px; height: 220px;">
                                                </div>
                                            </div>
                                            <div class="change-btn mt-2">
                                                <input type='file' class="form-control d-none" id="imageUpload"
                                                    name="avatar_path" accept=".png, .jpg, .jpeg">
                                                <label for="imageUpload"
                                                    class="btn btn-primary light btn-sm">{{ __('label.university.student.select_avatar') }}</label>
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
                            <h6 class="card-title">{{ __('label.university.student.detailed_information') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label required">{{ __('label.university.student.major') }}</label>
                                    <select id="multi-value-select" name="major_id"
                                        class="@error('major_id') is-invalid @enderror form-control">
                                        <option value="">{{ __('label.university.student.select_major') }}</option>
                                        @foreach ($majors as $major)
                                            <option value="{{ $major->id }}"
                                                {{ old('major_id', $student['major_id']) == $major->id ? 'selected' : '' }}>
                                                {{ $major->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('major_id')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label required">{{ __('label.university.student.email') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email', $student['email']) }}">
                                    @error('email')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label required">{{ __('label.university.student.phone') }}</label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone', $student['phone']) }}">
                                    @error('phone')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label required">{{ __('label.university.student.gender') }}</label>
                                    <div class="mt-2">
                                        <label><input type="radio" name="gender" value="{{ MALE_GENDER }}"
                                                {{ old('gender', $student['gender']) == MALE_GENDER ? 'checked' : '' }}>{{ __('label.university.student.male_gender') }}</label>
                                        <label class="ms-3"><input type="radio" name="gender"
                                                value="{{ FEMALE_GENDER }}"
                                                {{ old('gender', $student['gender']) == FEMALE_GENDER ? 'checked' : '' }}>
                                            {{ __('label.university.student.female_gender') }}</label>
                                    </div>
                                    @error('gender')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label required">{{ __('label.university.student.entry_graduation_year_range') }}</label>
                                    
                                    @php
                                        $entryYear = isset($student['entry_year']) ? $student['entry_year'] : '';
                                        $graduationYear = isset($student['graduation_year']) ? $student['graduation_year'] : '';
                                        if (app()->getLocale() == 'vi') {
                                            $dateRange = $entryYear . " đến " . $graduationYear;
                                        }else {
                                            $dateRange = $entryYear . " to " . $graduationYear;
                                        }
                                    @endphp

                                    <input type="text" id="dateRangePicker" class="form-control @error('date_range') is-invalid @enderror" name="date_range"
                                    value="{{ old('date_range', htmlspecialchars($dateRange)) }}"
                                    style="background-color: #fff">

                                    @error('date_range')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">{{ __('label.university.student.description') }}</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="tinymce_editor_init">{{ old('description', $student['description']) }}</textarea>
                                    @error('description')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('university.students.index') }}"
                                class="btn btn-light">{{ __('label.university.back') }}</a>
                            <button class="btn btn-primary" type="submit">{{ __('label.university.update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
     @if (Auth::guard('admin')->user()->role == ROLE_UNIVERSITY)
        <script>
            const universityAbbreviation = "{{ Auth::guard('admin')->user()->university->abbreviation }}";
        </script>
    @else
        <script>
            const universityAbbreviation = "{{ Auth::guard('admin')->user()->academicAffair->university->abbreviation }}";
        </script>
    @endif
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
    <script>
        //Date
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#dateRangePicker", {
                mode: "range",
                dateFormat: "Y-m-d",
                locale: "{{ app()->getLocale() }}" === 'vi' ? 'vn' : 'en',
                monthSelectorType: "static",
                yearSelectorType: "static",
                onClose: function(selectedDates, dateStr, instance) {
                    document.getElementById('dateRangePicker').value = dateStr;
                },
                onOpen: function(selectedDates, dateStr, instance) {
                    const calendar = instance.calendarContainer;
                    calendar.style.width = "19.9rem";
                },
            });
        });

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

      
        function removeVietnameseTones(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                .replace(/đ/g, "d").replace(/Đ/g, "D");
        }

        function generateSlug() {
            const name = $('#name').val().trim();
            const studentCode = $('#student_code').val().trim();

            // Kiểm tra nếu có cả tên và mã sinh viên, nếu không có thì không tạo slug
            if (name === '' || studentCode === '') {
                $('#slug').val('');
                return;
            }

            const slug = removeVietnameseTones(`${name}-${studentCode}`)
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '');

            $('#slug').val(slug + '-' + universityAbbreviation);
        }

        $('#name, #student_code').on('input', generateSlug);
    </script>
@endsection
