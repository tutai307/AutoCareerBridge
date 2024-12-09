@extends('management.layout.main')

@section('title', 'Danh sách lĩnh vực')

@section('css')
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
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách lĩnh vực</li>
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
                            <form method="GET" action="{{ route('admin.fields.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <label class="form-label">Tên lĩnh vực</label>
                                            <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                                value="{{ request()->search }}" placeholder="Tìm kiếm...">
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">Trạng thái</label>
                                            <select name="status" class="form-control default-select h-auto wide">
                                                <option value="" selected>Chọn trạng thái</option>
                                                <option value="{{ STATUS_PENDING }}"
                                                    {{ request()->status === strval(STATUS_PENDING) ? 'selected' : '' }}>
                                                    Chờ duyệt
                                                </option>
                                                <option value="{{ STATUS_APPROVED }}"
                                                    {{ request()->status === strval(STATUS_APPROVED) ? 'selected' : '' }}>
                                                    Đã duyệt
                                                </option>
                                                <option value="{{ STATUS_REJECTED }}"
                                                    {{ request()->status == STATUS_REJECTED ? 'selected' : '' }}>Từ chối
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 align-self-end">
                                            <div>
                                                <button class="btn btn-primary me-2" title="Click here to Search"
                                                    type="submit">
                                                    <i class="fa-sharp fa-solid fa-filter me-2"></i>Lọc
                                                </button>
                                                <button class="btn btn-danger light" title="Click here to remove filter"
                                                    type="button"
                                                    onclick="window.location.href='{{ route('admin.fields.index') }}'">
                                                    Xóa bộ lọc
                                                </button>
                                            </div>
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
                            <h2 class="card-title">Danh sách lĩnh vực</h2>
                            <a href="{{ route('admin.fields.create') }}" class="btn btn-primary">Thêm mới</a>
                        </div>
                        <div class="card-body p-0">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên lĩnh vực</th>
                                                <th>Người tạo</th>
                                                <th>Người sửa</th>
                                                <th>Đơn vị</th>
                                                <th>Trạng thái</th>
                                                <th>Mô tả</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($fields)
                                                @forelse ($fields as $item)
                                                    <tr>
                                                        <td><strong>{{ $loop->iteration + ($fields->currentPage() - 1) * $fields->perPage() }}</strong>
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->userCreate->user_name }}</td>
                                                        <td>{{ $item->userUpdate->user_name }}</td>
                                                        <td>{{ $item->user->company->name ?? ('Admin' ?? ($item->user->university->name ?? 'Admin')) }}
                                                        </td>
                                                        <td width="160px">
                                                            <button type="button" data-id="{{ $item->id }}"
                                                                data-url="{{ route('admin.fields.changeStatus') }}"
                                                                class="{{ $item->status === STATUS_APPROVED || $item->status === STATUS_REJECTED ? '' : 'btn_change_status' }} btn {{ $item->status == STATUS_PENDING ? 'btn-warning' : ($item->status == STATUS_APPROVED ? 'btn-success' : 'btn-danger') }} btn-sm">
                                                                {{ $item->status == STATUS_PENDING ? 'Chờ duyệt' : ($item->status == STATUS_APPROVED ? 'Đã duyệt' : 'Từ chối') }}
                                                            </button>
                                                        </td>
                                                        <td width="400px">
                                                            {!! $item->description ?? '' !!}
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="{{ route('admin.fields.edit', $item->id) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"
                                                                    data-type="POST" href="javascript:void(0)"
                                                                    data-url="{{ route('admin.fields.destroy', ['field' => $item->id]) }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Không có lĩnh vực nào.</td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    {{ $fields->links() }}
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
    <script>
        $(document).on('click', '.btn_change_status', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let url = $(this).data('url');
            let thisBtn = $(this);

            Swal.fire({
                title: "Bạn có muốn duyệt không ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Chấp nhận",
                cancelButtonText: "Từ chối",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'patch',
                            id: id,
                            confirm: 'accept'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                thisBtn.removeClass('btn-warning btn-danger btn_change_status')
                                    .addClass('btn-success').text(response.text_status);

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                            }
                        }
                    });
                } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'patch',
                            id: id,
                            confirm: 'reject'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                thisBtn.removeClass('btn-warning btn-success btn_change_status')
                                    .addClass('btn-danger').text(response.text_status);

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: response.message
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
