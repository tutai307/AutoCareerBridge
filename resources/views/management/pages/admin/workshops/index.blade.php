@extends('management.layout.main')

@section('title', 'Quản lý workshop')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Thống kê</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách bài đăng</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>Lọc
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="handle expand"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="">
                    <form method="GET" action="{{route('admin.workshops.index')}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6">
                                    <label class="form-label">Tên workshop hoặc tên trường</label>
                                    <input type="text" class="form-control mb-xl-0 mb-3" name="search" value="{{request()->search}}"
                                           placeholder="Tìm kiếm...">
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="status" class="form-control default-select h-auto wide">
                                            <option value="" @if(request()->status == "") selected @endif>Chọn trạng thái</option>
                                            <option value="0" @if(request()->status == STATUS_PENDING) selected @endif>Chưa tổ chức</option>
                                            <option value="1" @if(request()->status == STATUS_APPROVED) selected @endif>Đang tiến hành</option>
                                            <option value="2" @if(request()->status == STATUS_REJECTED) selected @endif>Đã kết thúc</option>
                                        </select>

                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-sm-6 align-self-end">
                                    <div>
                                        <button class="btn btn-primary me-2" title="Click here to Search" type="submit">
                                            <i class="fa-sharp fa-solid fa-filter me-2"></i>Lọc
                                        </button>
                                        <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{route('admin.workshops.index')}}'">
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Danh sách bài đăng tuyển dụng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>Tên workshop</th>
                                <th>Trường tổ chức</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($workshops->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Không có workshop nào.
                                    </td>
                                </tr>
                            @endif
                            @foreach($workshops as $index => $workshop)
                                <tr>
                                    <td>
                                        <strong>{{$index + 1 + ($workshops->currentPage() - 1) * $workshops->perPage()}}</strong>
                                    </td>
                                    <td>
                                        {{$workshop->name}}
                                    </td>
                                    <td>
                                        {{$workshop->university_name}}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($workshop->start_date)->format('d/m/Y, H:i') }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($workshop->end_date)->format('d/m/Y, H:i') }}
                                    </td>
                                    <td>
                                        @if(now() < $workshop->start_date)
                                            <div class="d-flex align-items-center"><i class="fa fa-circle text-alert me-1"></i> Chưa tổ chức</div>
                                        @elseif(now() > $workshop->start_date && now() < $workshop->end_date)
                                            <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> Đang tiến hành</div>
                                        @elseif(now() > $workshop->end_date)
                                            <div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> Đã kết thúc</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary shadow btn-xs btn-show-details" data-slug="{{ $workshop->slug }}" data-bs-toggle="modal" >
                                                <i class="fa-solid fa-file-alt"></i> Chi tiết
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($workshops->lastPage() > 1)
                        {{ $workshops->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Modal toàn màn hình với các trường đều 2 bên -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%;"> <!-- Đặt chiều rộng tối đa là 80% -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Chi tiết workshop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form bên trong modal -->
                    <form action="" id="jobForm" method="POST">
                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề</label>
                                    <div class="d-flex flex-column">
                                        <input type="text" class="form-control mb-2" name="name" value="Tiêu đề" disabled>
                                        <div>
                                            <img id="avatar_path" src="https://images.kienthuc.net.vn/zoom/800/uploaded/hongnhat/2013_12_20/anh%20vn%201_ktt%2020.12_kienthuc_lziu.jpg" alt="Doanh nghiệp" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trường tổ chức</label>
                                    <div class="d-flex flex-column">
                                        <!-- Trường Doanh nghiệp -->
                                        <input type="text" class="form-control mb-2" name="university_name" value="Tên Trường" disabled>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Thời gian tổ chức</label>
                                    <input type="text" class="form-control" name="start_date" value="18/11/2024, 21:34" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Thời gian kết thúc</label>
                                    <input type="text" class="form-control" name="end_date" value="18/11/2024, 21:35" disabled>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Số doanh nghiệp tham gia/Tổng</label>
                                    <input type="text" class="form-control" name="rate" value="6/10" disabled>
                                </div>

                            </div>

                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nội dung bài đăng</label>
                                    <div class="content" style="max-height: 600px; overflow-y: auto; background-color: #E6EBEE; border-radius: 10px; padding: 10px; color: #333333; font-weight: normal;">
                                        <!-- Nội dung HTML của bạn sẽ được đưa vào đây -->
                                        <div class="mb-3 detailJobs">
                                            <p><strong>Tiêu đề:</strong> Bài đăng mẫu</p>
                                            <p><strong>Nội dung:</strong> Đây là <strong>nội dung workshop</strong>, có thể chứa các thẻ HTML như <em>mã nguồn</em>, <strong>in đậm</strong>, và các thẻ khác.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bắt sự kiện khi nhấn vào nút "Chi tiết"
            document.querySelectorAll('.btn-show-details').forEach(function (button) {
                button.addEventListener('click', function () {
                    var jobSlug = this.getAttribute('data-slug'); // Lấy slug của bài đăng từ thuộc tính data-slug
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
                    // Gửi yêu cầu Fetch đến server để lấy chi tiết bài đăng dựa trên slug
                    fetch(`{{ route('admin.workshops.slug', ':slug') }}`.replace(':slug', jobSlug))
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (data) {

                            if(data.message) return Toast.fire({
                                icon: "error",
                                title: "Lỗi: " + data.message
                            });
                            data = data[0]
                            // Đổ dữ liệu vào modal
                            document.querySelector('#detailsModal input[name="name"]').value = data.name;
                            document.querySelector('#detailsModal img[id="avatar_path"]').src = data.avatar_path
                            document.querySelector('#detailsModal input[name="university_name"]').value = data.university_name;
                            document.querySelector('#detailsModal input[name="start_date"]').value = data.start_date;
                            document.querySelector('#detailsModal input[name="end_date"]').value = data.end_date;
                            document.querySelector('#detailsModal input[name="rate"]').value = `${data.company_count}/${data.amount}`;

                            // Đổ nội dung bài đăng vào content
                            document.querySelector('#detailsModal .detailJobs').innerHTML = data.content;

                            $('#detailsModal').modal('show');
                        })
                        .catch(function (error) {
                            console.error('Error:', error);

                            Toast.fire({
                                icon: "error",
                                title: "Lỗi: " + error.message
                            });
                        });
                });
            });
        });

    </script>
@endsection


