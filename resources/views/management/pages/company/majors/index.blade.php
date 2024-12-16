@extends('management.layout.main')
@section('title', 'Danh sách chuyên ngành')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('management-assets/css/admins/fields.css') }}">

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
                                <li class="breadcrumb-item active" aria-current="page">Danh sách chuyên ngành</li>
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
                                <i class="fa-sharp fa-solid fa-filter me-2"></i>Lọc
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt">
                            <form method="GET" action="{{ route('company.majorCompany') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">Chọn lĩnh vực</label>
                                            <select name="field_id" id="fieldSelect"
                                                class="multi-value-select" style="width:100%;">
                                                <option value="">Chọn lĩnh vực</option>
                                                @foreach ($fields as $field)
                                                    <option value="{{ $field->id }}"
                                                        {{ old('field_id', request('field_id')) == $field->id ? 'selected' : '' }}>
                                                        {{ $field->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">Chuyên ngành</label>
                                            <select id="majorSelect" name="major_id"
                                             class="multi-value-select" style="width:100%;">
                                                <option value="">Chọn chuyên ngành</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
                                                <i class="fa-sharp fa-solid fa-filter me-2"></i>Lọc
                                            </button>
                                            <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{ route('company.majorCompany') }}'">
                                                Xoá bộ lọc
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card quick_payment">
                        <div class="card-header border-0 pb-2 d-flex justify-content-between">
                            <h2 class="card-title">Danh sách chuyên ngành</h2>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('company.createMajorCompany') }}" class="btn btn-primary ms-2">Thêm
                                    mới</a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên chuyên ngành</th>
                                                <th>Lĩnh vực</th>
                                                <th>Mô tả</th>
                                                <th>Thời gian tạo</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($majors as $major)
                                                <tr>
                                                    <td><strong>{{ $loop->iteration + ($majors->currentPage() - 1) * $majors->perPage() }}</strong>
                                                    </td>
                                                    <td style="width:20%;">{{ $major->name ?? '' }}</td>
                                                    <td>{{ $major->field->name ?? '' }}</td>
                                                    <td style="width: 30%;">{{ $major->description ?? '' }}</td>
                                                    <td style="width: 0%;">{{ $major->companies->first()->pivot->created_at->format('d/m/Y') ?? '' }}</td>
                                                    <td>
                                                        <div>
                                                            <form
                                                                action="{{ route('company.deleteMajorCompany', ['majorId' => $major->id]) }}"
                                                                method="POST" style="display:inline;" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                                    data-id="">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center">Không có chuyên ngành nào.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <div class="dataTables_paginate">
                                    {{ $majors->appends(request()->query())->links() }}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('.delete-form');
            Swal.fire({
                title: "Bạn có chắc muốn xóa không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Xóa",
                cancelButtonText: "Hủy",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Hàm để tải các chuyên ngành dựa trên lĩnh vực đã chọn
            function loadMajors(fieldId, selectedMajorId = '') {
                $.ajax({
                    url: '/api/majorsAll?field_id=' + fieldId, // Gọi API với field_id
                    method: 'GET',
                    success: function(response) {
                        var majorSelect = $('#majorSelect');
                        majorSelect.empty(); // Xóa các tùy chọn hiện tại
                        majorSelect.append(
                        '<option value="">Chọn chuyên ngành</option>'); // Thêm option mặc định

                        // Thêm các chuyên ngành vào dropdown
                        response.forEach(function(major) {
                            majorSelect.append('<option value="' + major.id + '" ' +
                                (selectedMajorId == major.id ? 'selected' : '') + '>' +
                                major.name + '</option>');
                        });

                        majorSelect.selectpicker(
                        'refresh'); // Refresh lại selectpicker nếu đang sử dụng
                    }
                });
            }

            // Sự kiện khi thay đổi lĩnh vực
            $('#fieldSelect').on('change', function() {
                var fieldId = $(this).val();
                // Kiểm tra xem có lĩnh vực đã được chọn
                if (fieldId) {
                    loadMajors(fieldId,
                    '{{ old('major_id', request('major_id')) }}'); // Giữ lại major_id đã chọn khi thay đổi
                } else {
                    // Nếu không có lĩnh vực nào, làm trống chuyên ngành
                    $('#majorSelect').empty().append('<option value="">Chọn chuyên ngành</option>')
                        .selectpicker('refresh');
                }
            });

            // Tải lại chuyên ngành nếu đã có lĩnh vực được chọn khi trang được load
            var fieldId = $('#fieldSelect').val();
            if (fieldId) {
                loadMajors(fieldId,
                '{{ old('major_id', request('major_id')) }}'); // Giữ lại lựa chọn cũ của chuyên ngành khi trang được tải lại
            }
        });
    </script>
@endsection
