@extends('management.layout.main')

@section('title', 'Danh sách nhân viên')

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
                            <li class="breadcrumb-item"><a href="/company">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách nhân viên</li>
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
                        <form method="GET" action="{{ route('company.manageHiring') }}">
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
                                            onclick="window.location.href='{{ route('company.manageHiring') }}'">
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
                        <h2 class="card-title">Danh sách nhân viên</h2>
                        <a href="{{ route('company.create') }}" class="btn btn-success">Thêm mới</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-sm mb-0 table-striped order-table">
                                                        <thead>
                                                            <tr>
                                                                <th class=" pe-3">      
                                                                </th>
                                                                <th>Tên đầy đủ</th>
                                                                <th>Tên đăng nhập</th>
                                                                <th>Email</th>
                                                                <th>Số điện thoại</th>
                                                                <th>Ngày tạo</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                        </thead>
                                                      
                                                        <tbody id="customers">
                                                            @forelse($hirings as $hiring)
                                                            <tr class="btn-reveal-trigger">
                                                         
                                                                @if ($hiring->avatar_path)
                                                                <td><img class="rounded-circle" width="45" height="45" src=" {{ asset('storage/' . $hiring->avatar_path) }}"
                                                                        alt=""></td>
                                                                @else
                                                                <td><img class="rounded-circle" width="45" height="45" src=" {{ asset('management-assets/images/no-img-avatar.png') }}"></td>
                                                                @endif
                                                               
                                                                <td class="py-2">{{$hiring->name}}</td>
                                                                <td class="py-2">{{$hiring->user->user_name}}</td>
                                                                <td class="py-2">{{$hiring->user->email}}</td>
                                                                <td class="py-2">{{$hiring->phone}}</td>
                                                                <td class="py-2">{{$hiring->user->created_at}}</td>
                                                                <td class="py-2 text-end">
                                                                    <div class="ms-auto">
                                                                        <a href="{{ route('company.editHiring',$hiring->user_id) }}"
                                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                                class="fa fa-pencil"></i></a>
                    
                                                                      
                                                                                <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"
                                                                                data-type="POST" href="javascript:void(0)"
                                                                                data-url="{{ route('company.deleteHiring',$hiring->user->id) }}">
                                                                                <i class="fa fa-trash"></i>
                                                                            </a>
                                                                    </div>
                                                                </td>
                                                                
                                                                @empty
                                                                <td colspan="6" class="text-center">Không có dữ liệu</td>           
                                                            @endforelse
                                    
                                    
                                    
                                                        </tbody>
                                                    </table>
                                                    <div id="pagination" class="mt-4 d-flex justify-content-between align-items-center">
                                            {{ $hirings->links('pagination::bootstrap-4') }}
                                        </div>
                                                </div>
                                    
                                            </div>
                                    
                                        </div>
                                    
                                    </div>
                                </table>
                               
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