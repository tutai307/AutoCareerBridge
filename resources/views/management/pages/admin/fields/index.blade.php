@extends('management.layout.main')

@section('title', 'Danh sách lĩnh vực')

@section('css')
    <style>
        .table tbody tr td {
            white-space: normal;
        }
    </style>
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
                {{-- <div class="col-xl-12">
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
                            <form method="GET" action="{{ route('admin.users.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6">
                                            <label class="form-label">Tên đăng nhập hoặc email</label>
                                            <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                                   value="{{ request()->search }}" placeholder="Tìm kiếm...">
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">Vai trò</label>
                                            <select name="role" class="form-control default-select h-auto wide">
                                                <option value="all">Chọn vai trò</option>
                                                <option value="{{ ROLE_SUB_ADMIN }}"
                                                    {{ request()->role == ROLE_SUB_ADMIN ? 'selected' : '' }}>Sub Admin
                                                </option>
                                                <option value="{{ ROLE_UNIVERSITY }}"
                                                    {{ request()->role == ROLE_UNIVERSITY ? 'selected' : '' }}>Trường
                                                    học</option>
                                                <option value="{{ ROLE_COMPANY }}"
                                                    {{ request()->role == ROLE_COMPANY ? 'selected' : '' }}>Doanh
                                                    nghiệp</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                            <label class="form-label">Trạng thái</label>
                                            <select name="active" class="form-control default-select h-auto wide">
                                                <option value="all" selected>Chọn trạng thái</option>
                                                <option value="{{ ACTIVE }}"
                                                    {{ request()->active === strval(ACTIVE) ? 'selected' : '' }}>Kích hoạt</option>
                                                <option value="{{ INACTIVE }}"
                                                    {{ request()->active == INACTIVE ? 'selected' : '' }}>Chưa kích hoạt
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-xl-2 col-sm-6">
                                            <label class="form-label">Ngày tham gia</label>
                                            <div class="input-hasicon mb-sm-0 mb-3">
                                                <input type="date" name="date" class="form-control"
                                                       value="{{ request()->date }}">
                                                <div class="icon"><i class="far fa-calendar"></i></div>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-sm-6 align-self-end">
                                            <div>
                                                <button class="btn btn-primary me-2" title="Click here to Search"
                                                        type="submit">
                                                    <i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm
                                                </button>
                                                <button class="btn btn-danger light" title="Click here to remove filter"
                                                        type="button"
                                                        onclick="window.location.href='{{ route('admin.users.index') }}'">
                                                    Xóa
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
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
                                                <th>Slug</th>
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
                                                        <td>
                                                            <span class="w-space-no">{{ $item->name }}</span>
                                                        </td>
                                                        <td>{{ $item->slug }}</td>
                                                        <td width="160px">
                                                            <select class="form-control text-white bg-warning" name="status">
                                                                <option value="0"
                                                                    {{ $item->status == 0 ? 'selected' : '' }}>Chờ
                                                                    duyệt</option>
                                                                <option value="1"
                                                                    {{ $item->status == 1 ? 'selected' : '' }}>Duyệt
                                                                </option>
                                                                <option value="2"
                                                                    {{ $item->status == 2 ? 'selected' : '' }}>Từ chối
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td width="400px">
                                                            {!! $item->description ?? 'Không có' !!}
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <a href="{{ route('admin.fields.edit', $item->id) }}"
                                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <form
                                                                    action="{{ route('admin.fields.destroy', $item->id) }}"
                                                                    method="POST" style="display:inline;"
                                                                    class="delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button"
                                                                        class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                                        data-id="{{ $item->id }}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">Không có người dùng nào.</td>
                                                    </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                {{ $fields->links() }}
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
@endsection
