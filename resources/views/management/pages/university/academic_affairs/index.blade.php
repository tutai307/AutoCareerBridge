@extends('management.layout.main')

@section('title', 'Danh sách giáo vụ')

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
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách giáo vụ</li>
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
                        <form method="GET" action="{{ route('university.academicAffairs') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <label class="form-label">Tên Đầy Đủ</label>
                                        <input type="text" class="form-control" name="searchName"
                                            value="{{ request()->searchName }}" placeholder="Tìm kiếm...">
                                    </div>

                                    <div class="col-xl-3 col-sm-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="searchEmail"
                                            value="{{ request()->searchEmail }}" placeholder="Tìm kiếm...">
                                    </div>
                                    <div class="col-xl-3 col-sm-6 align-self-end mb-3">
                                        <button class="btn btn-primary me-2" title="Click here to Search"
                                            type="submit">
                                            <i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm
                                        </button>
                                        <button class="btn btn-danger light" title="Click here to remove filter"
                                            type="button"
                                            onclick="window.location.href='{{ route('university.academicAffairs') }}'">
                                            Xóa
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
                        <h2 class="card-title">Danh sách giáo vụ</h2>
                        <a href="{{ route('university.createAcademicAffairs') }}" class="btn btn-success">Thêm mới</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên giáo vụ</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($academicAffairs as $academicAffair)
                                        <tr>
                                            @if ($academicAffair->avatar_path)
                                            <td><img class="rounded-circle" width="45" height="45" src=" {{ asset('storage/' . $academicAffair->avatar_path) }}"
                                                    alt=""></td>
                                            @else
                                            <td><img class="rounded-circle" width="45" height="45" src=" {{ asset('management-assets/images/no-img-avatar.png') }}"></td>
                                            @endif

                                            <td>{{ $academicAffair->name }}</td>
                                            <td>{{ $academicAffair->user->user_name }}</td>
                                            <td>{{ $academicAffair->user->email }}</td>
                                            <td>{{ $academicAffair->phone }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('university.editAcademicAffairs',$academicAffair->user_id) }}"
                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                            class="fa fa-pencil"></i></a>

                                                    <button type="button" class="btn btn-danger btn-xs sharp" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{$academicAffair->user->id}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>


                                                    <div class="modal fade" id="deleteConfirmationModal{{$academicAffair->user->id}}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Xác Nhận Xóa</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-start">
                                                                    Bạn có chắc chắn muốn xóa bản ghi này không?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                    <form action="{{ route('university.deleteAcademicAffairs',$academicAffair->user->id) }}" id="" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Không có giáo vụ nào.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div id="pagination" class="mt-4 d-flex justify-content-between align-items-center">
                                    <p>Hiển thị từ {{ $academicAffairs->firstItem() }} đến {{ $academicAffairs->lastItem() }} trong tổng số {{ $academicAffairs->total() }} giáo vụ.</p>
                                    {{ $academicAffairs->links('pagination::bootstrap-4') }}
                                </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#dateRangePicker", {
            mode: "range",
            dateFormat: "d/m/Y",
            locale: "vn",
            onClose: function(selectedDates, dateStr, instance) {
                document.getElementById('dateRangePicker').value = dateStr;
            }
        });
    });
</script>
@endsection