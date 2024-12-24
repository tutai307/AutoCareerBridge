@extends('management.layout.main')

@section('title', __('label.company.job.create_job'))

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('company.storeJob') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('university.students.index') }}">{{ __('label.company.job.title_job') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.company.job.create_job') }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="card profile-card card-bx m-b30">
                        <div class="card-header">
                            <h6 class="card-title">{{ __('label.company.job.detailed_information') }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">{{ __('label.company.job.title') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('label.company.job.title') }}" name="name" id="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">{{ __('label.company.job.slug') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="slug"
                                        class="form-control @error('slug') is-invalid @enderror" name="slug"
                                        value="{{ old('slug') }}" placeholder="Slug">
                                    @error('slug')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 m-b30">
                                    <label class="form-label">{{ __('label.company.job.detail') }} <span
                                            class="text-danger">*</span></label>
                                    <textarea name="detail" id="detail" cols="30" rows="10" class="tinymce_editor_init">{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <span class="d-block text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('company.manageJob') }}"
                                class="btn btn-light">{{ __('label.company.job.back') }}</a>
                            <button class="btn btn-primary" type="submit">{{ __('label.company.job.create') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="clearfix">
                        <div class="card card-bx profile-card author-profile m-b30">
                            <div class="card-header">
                                <h6 class="card-title"> {{ __('label.company.job.information') }}</h6>
                            </div>
                            <div class="card-footer">
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30 cm-content-body form excerpt">
                                        <label class="form-label">{{ __('label.company.job.major') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="multi-value-select" name="major_id"
                                            class="@error('major_id') is-invalid @enderror">
                                            <option value="" @if (old('major_id') == '') selected @endif>
                                                {{ __('label.company.job.select_major') }}
                                            </option>
                                            @foreach ($majors as $major)
                                                <option value="{{ $major->id }}"
                                                    @if (old('major_id') == $major->id) selected @endif>{{ $major->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('major_id')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">{{ __('label.company.job.expiration_date') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ old('end_date') }}" min="{{ date('Y-m-d') }}">
                                        @error('end_date')
                                            <span class="d-block text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-start">
                                    <div class="col-sm-12 m-b30">
                                        <label class="form-label">{{ __('label.company.job.skill') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="multi-value-select" multiple="multiple" name="skill_name[]">
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->name }}"
                                                    {{ in_array($skill->name, old('skill_name', [])) ? 'selected' : '' }}>
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
                </div>
            </div>
        </form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="../vendor/select2/css/select2.min.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        //Slug
        function removeVietnameseTones(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                .replace(/đ/g, "d").replace(/Đ/g, "D");
        }

        function generateSlug() {
            const name = $('#name').val().trim();

            const slug = removeVietnameseTones(`${name}`)
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '');

            $('#slug').val(slug);
        }

        $('#name').on('input', generateSlug);
    </script>
@endsection
