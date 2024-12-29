@extends('management.layout.main')

@section('title', __('label.admin.management_university.workshop.list_workshop'))

@section('css')
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/clockpicker/css/bootstrap-clockpicker.min.css">
    <link rel="stylesheet"
        href="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/pickadate/themes/default.date.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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
                                <li class="breadcrumb-item active" aria-current="page">Danh sách workshop</li>
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
                            <form method="GET" action="{{ route('university.workshop.index') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-5 col-sm-6 mb-3">
                                            <label class="form-label">Tên workshop</label>
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request()->search }}" placeholder="Tìm kiếm...">
                                        </div>

                                        <div class="col-xl-3 col-sm-6 mb-3">
                                            <label class="form-label">Thời gian bắt đầu - kết thúc</label>
                                            <input class="form-control input-daterange-datepicker" type="text"
                                                name="date_range" value="{{ request()->date_range ?? '' }}"
                                                placeholder="Nhấn để chọn khoản thời gian">
                                        </div>

                                        <div class="col-xl-4 col-sm-6 align-self-end mb-3">
                                            <button class="btn btn-primary me-2" title="Click here to Search"
                                                type="submit">
                                                <i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm
                                            </button>
                                            <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{ route('university.workshop.index') }}'">
                                                Xóa lọc
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
                            <h2 class="card-title">Danh sách workshop</h2>
                            <a href="{{ route('university.workshop.create') }}" class="btn btn-primary">Thêm mới</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tên workshop</th>
                                                <th>Ảnh</th>
                                                <th>Thời gian bắt đầu</th>
                                                <th>Thời gian kết thúc</th>
                                                <th>Số lượng tham gia</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($workshops as $workshop)
                                                <tr>
                                                    <td><strong>{{ $loop->iteration + ($workshops->currentPage() - 1) * $workshops->perPage() }}</strong>
                                                    </td>
                                                    <td>{{ $workshop->name }}</td>
                                                    <td>
                                                        @if ($workshop->avatar_path)
                                                            <img src="{{ asset($workshop->avatar_path) }}"
                                                                alt="{{ $workshop->name }}"
                                                                style="max-width: 100px; max-height: 100px; object-fit: cover;" />
                                                        @else
                                                            <span class="text-muted">Chưa có ảnh</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $workshop->start_date }}</td>
                                                    <td>{{ $workshop->end_date }}</td>
                                                    <td>{{ $workshop->amount }}</td>
                                                    <td>
                                                        @if (\Carbon\Carbon::now()->between($workshop->start_date, $workshop->end_date))
                                                            <span class="badge bg-info">Đang diễn ra</span>
                                                        @elseif (\Carbon\Carbon::now()->gt($workshop->end_date))
                                                            <span class="badge bg-success">Đã hoàn thành</span>
                                                        @else
                                                            <span class="badge bg-warning">Chưa bắt đầu</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a title="Sửa"
                                                            href="{{ route('university.workshop.edit', $workshop->id) }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fa fa-pencil"></i></a>
                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"
                                                            data-type="DELETE"
                                                            data-message="{{ __('label.delete_confirm') }}"
                                                            data-irreversible_action="{{ __('label.irreversible_action') }}"
                                                            data-delete="{{ __('label.delete') }}"
                                                            data-cancel="{{ __('label.cancel') }}"
                                                            href="javascript:void(0)"
                                                            data-url="{{ route('university.workshop.destroy', ['workshop' => $workshop->id]) }}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">Không có workshop nào.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                {{ $workshops->appends(request()->query())->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('management-assets') }}/vendor/moment/moment.min.js"></script>
    <script src="{{ asset('management-assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script
        src="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>
    <script src="{{ asset('management-assets') }}/js/plugins-init/bs-daterange-picker-init.js"></script>
@endsection
