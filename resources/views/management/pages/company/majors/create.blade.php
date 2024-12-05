@extends('management.layout.main')
@section('title', 'Thêm mới chuyên ngành')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('university.home') }}">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Thêm mới chuyên ngành</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader">
                            <div class="cpa">
                                <i class="fa-sharp fa-solid fa-plus me-2"></i>Thêm mới
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="POST" action="{{ route('company.storeMajorCompany') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-sm-12 mb-3">
                                            <label class="form-label">Chọn lĩnh vực</label>
                                            <select name="field_id" id="fieldSelect"
                                              class="multi-value-select"  style="width:100%;">
                                                <option value="">Chọn lĩnh vực</option>
                                                @foreach ($fields as $field)
                                                    <option value="{{ $field->id }}"
                                                        {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                                        {{ $field->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('field_id')
                                                <span class="d-block text-danger mt-2">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="col-xl-12 col-sm-12 mb-3">
                                             <label class="form-label">Chuyên ngành <span
                                                class="text-danger">*</span></label>
                                        <select class="multi-value-select" multiple="multiple" id="majorSelect" name="major_id[]">
                                            
                                        </select>
                                            @error('major_id')
                                                <span class="d-block text-danger mt-2">{{ $message }}</span>
                                            @enderror
                                         
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                                            <!-- Nút bên trái -->
                                            <a href="{{ route('company.majorCompany') }}" class="btn btn-light">Quay lại</a>

                                            <!-- Nút bên phải -->
                                            <button class="btn btn-primary" title="Click here to Search" type="submit">
                                                <i class="fa-sharp fa-solid fa-plus me-2"></i>Thêm
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Hàm để tải các chuyên ngành dựa trên lĩnh vực đã chọn
        function loadMajors(fieldId) {
            $.ajax({
                url: '/api/company-majors?field_id=' + fieldId, // Gọi API với field_id
                method: 'GET',
                success: function(response) {
                    var majorSelect = $('#majorSelect');
                    majorSelect.empty(); // Xóa các tùy chọn hiện tại
                    response.forEach(function(major) {
                        majorSelect.append('<option value="' + major.id + '">' +
                            major.name + '</option>');
                    });
                    majorSelect.selectpicker('refresh');
                }
            });
        }

        // Khi thay đổi lĩnh vực, gọi hàm loadMajors
        $('#fieldSelect').on('change', function() {
            var fieldId = $(this).val();

            if (fieldId) {
                loadMajors(fieldId);
            } else {
                $('#majorSelect').empty().selectpicker('refresh');
            }
        });

        // Khi trang đã load lại do validate lỗi, gọi lại hàm loadMajors cho lĩnh vực đã chọn
        $(document).ready(function() {
            var selectedFieldId = $('#fieldSelect').val();
            if (selectedFieldId) {
                loadMajors(selectedFieldId);
            }
        });
    </script>
@endsection
