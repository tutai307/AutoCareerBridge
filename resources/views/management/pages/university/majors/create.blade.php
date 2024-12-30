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
                            <form method="POST" action="{{ route('university.majors.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-sm-12 mb-3">
                                            <label class="form-label">Chọn lĩnh vực</label>
                                            <select name="fields" id="fieldSelect"
                                                class="single-select-placeholder js-states" style="width:100%;">
                                                <option value="">Chọn lĩnh vực</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12 col-sm-12 mb-3">
                                            <label class="form-label">Chuyên ngành</label>
                                            <select id="majorSelect" name="major_id[]"
                                                class="multi-select-placeholder js-states" style="width:100%;"
                                                multiple="multiple">
                                                <option value="" data-field-id="Chọn chuyên ngành"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
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
        $(document).ready(function() {
            // Hàm để tải các lĩnh vực
            function loadFields() {
                $.ajax({
                    url: '/api/fields',
                    method: 'GET',
                    success: function(response) {
                        var fieldSelect = $('#fieldSelect');
                        fieldSelect.empty();
                        fieldSelect.append(
                            '<option value="">-- Chọn lĩnh vực --</option>'); // Thêm tùy chọn mặc định
                        response.forEach(function(field) {
                            fieldSelect.append('<option value="' + field.id + '">' + field
                                .name + '</option>');
                        });
                        // fieldSelect.selectpicker('refresh');
                    }
                });
            }

            // Hàm để tải các chuyên ngành dựa trên lĩnh vực đã chọn
            function loadMajors(fieldId) {
                $.ajax({
                    url: '/api/majors?field_id=' + fieldId, // Gọi API với field_id
                    method: 'GET',
                    success: function(response) {
                        var majorSelect = $('#majorSelect');
                        majorSelect.empty(); // Xóa các tùy chọn hiện tại
                        response.forEach(function(major) {
                            majorSelect.append('<option selected value="' + major.id + '">' +
                                major
                                .name + '</option>');
                        });
                        majorSelect.selectpicker('refresh');
                    }
                });
            }

            // Gọi hàm loadFields khi trang được tải
            loadFields();

            // Sự kiện khi thay đổi lĩnh vực
            $('#fieldSelect').on('change', function() {
                var fieldId = $(this).val();
                if (fieldId) {
                    loadMajors(fieldId);
                } else {
                    $('#majorSelect').empty().selectpicker(
                        'refresh'); // Xóa chuyên ngành nếu không có lĩnh vực
                }
            });
        });
    </script>
@endsection
