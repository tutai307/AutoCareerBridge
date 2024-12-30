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
                            <form method="GET" action="{{ route('university.majors.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">Chọn lĩnh vực</label>
                                            <select name="field_id" id="fieldSelect"
                                                class="single-select-placeholder js-states" style="width:100%;">
                                                <option value="">Chọn lĩnh vực</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">Chuyên ngành</label>
                                            <select id="majorSelect" name="major_id"
                                                class="single-select-placeholder js-states" style="width:100%;">
                                                <option value="" data-field-id="Chọn chuyên ngành"></option>
                                            </select>
                                        </div>


                                        <div class="col-xl-3 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
                                                <i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm
                                            </button>
                                            <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{ route('university.majors.index') }}'">
                                                Xoá
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
                                <a href="{{ route('university.majors.create') }}" class="btn btn-primary ms-2">Thêm mới</a>
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
                                                <th>Mô tả</th>
                                                <th>Thời gian tạo</th>
                                                <th>Lần cập nhật cuối</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($majors as $major)
                                                <tr>
                                                    <td><strong>{{ $loop->iteration + ($majors->currentPage() - 1) * $majors->perPage() }}</strong>
                                                    </td>
                                                    <td>{{ $major->major->name ?? '' }}</td>
                                                    <td >{{ $major->major->description ?? '' }}</td>
                                                    <td>{{ $major->created_at ?? '' }}</td>
                                                    <td>{{ $major->updated_at ?? '' }}</td>
                                                    <td>
                                                        <div>
                                                            <form
                                                                action="{{ route('university.majors.destroy', ['major' => $major->major_id]) }}"
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

                            <div class="card-footer">
                                {{ $majors->links() }}
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
                    url: '/api/majorsAll?field_id=' + fieldId, // Gọi API với field_id
                    method: 'GET',
                    success: function(response) {
                        var majorSelect = $('#majorSelect');
                        majorSelect.empty(); // Xóa các tùy chọn hiện tại
                        response.forEach(function(major) {
                            majorSelect.append('<option value="' + major.id + '">' +
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
