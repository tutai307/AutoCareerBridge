@extends('management.layout.main')

@section('title', 'Danh sách bài đăng')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Thống kê</a></li>
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
                    <form method="GET" action="{{ route('admin.jobs.index') }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6">
                                    <label class="form-label">Tên job hoặc tên doanh nghiệp</label>
                                    <input type="text" class="form-control mb-xl-0 mb-3" name="search"
                                        value="{{ request()->search }}" placeholder="Tìm kiếm...">
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="status" class="form-control default-select h-auto wide">
                                            <option value="" @if (request()->status == '') selected @endif>Chọn
                                                trạng thái</option>
                                            <option value="0" @if (request()->status == STATUS_PENDING) selected @endif>Chờ phê
                                                duyệt</option>
                                            <option value="1" @if (request()->status == STATUS_APPROVED) selected @endif>Đã phê
                                                duyệt</option>
                                            <option value="2" @if (request()->status == STATUS_REJECTED) selected @endif>Từ chối
                                            </option>
                                        </select>

                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">Chuyên ngành</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="major" class="form-control default-select h-auto wide">
                                            <option value="" @if ('' == request()->major) selected @endif>Chọn
                                                chuyên ngành</option>
                                            @foreach ($majors as $major)
                                                <option value="{{ $major->id }}"
                                                    @if ($major->id == request()->major) selected @endif>{{ $major->name }}
                                                </option>
                                            @endforeach
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
                                            <i class="fa-sharp fa-solid fa-filter me-2"></i>Tìm kiếm
                                        </button>
                                        <button class="btn btn-light light" title="Click here to remove filter"
                                            type="button" onclick="window.location.href='{{ route('admin.jobs.index') }}'">
                                            Xóa
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
                                    <th>Tiêu đề</th>
                                    <th>Doanh nghiệp</th>
                                    <th>Chuyên ngành yêu cầu</th>
                                    <th>Ngày đăng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($jobs->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Không có Jobs nào.
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($jobs as $index => $job)
                                    <tr>

                                        <td><strong>{{ $index + 1 + ($jobs->currentPage() - 1) * $jobs->perPage() }}</strong>
                                        </td>
                                        <td>
                                            <span class="w-space-no">{{ $job->name }}</span>
                                        </td>
                                        <td>{{ $job->company->name ?? '' }}</td>
                                        {{-- <td>{{$job->company_name}}</td> --}}
                                        <td>{{ $job->major->name }}</td>
                                        <td>{{ $job->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if ($job->status == STATUS_PENDING)
                                                <div class="d-flex align-items-center"><i
                                                        class="fa fa-circle text-warning me-1"></i> Chờ phê duyệt
                                                </div>
                                            @elseif($job->status == STATUS_APPROVED)
                                                <div class="d-flex align-items-center"><i
                                                        class="fa fa-circle text-success me-1"></i> Đã duyệt
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center"><i
                                                        class="fa fa-circle text-danger me-1"></i>
                                                    Đã từ chối
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <a href="#" class="btn btn-primary shadow btn-xs btn-show-details"
                                                    data-slug="{{ $job->slug }}" data-bs-toggle="modal">
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
                    @if ($jobs->lastPage() > 1)
                        {{ $jobs->links() }}
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
                    <h5 class="modal-title" id="detailsModalLabel">Chi tiết bài đăng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form bên trong modal -->
                    <form action="{{ route('admin.jobs.updateStatus') }}" id="jobForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài đăng</label>
                                    <input type="text" class="form-control" name="name" value="Tiêu đề bài đăng"
                                        disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Doanh nghiệp</label>
                                    <div class="d-flex flex-column">
                                        <!-- Trường Doanh nghiệp -->
                                        <input type="text" class="form-control mb-2" name="company_name"
                                            value="Tên doanh nghiệp" disabled>
                                        <!-- Ảnh Doanh nghiệp -->
                                        <div>
                                            <img id="company_avatar_path"
                                                src="https://images.kienthuc.net.vn/zoom/800/uploaded/hongnhat/2013_12_20/anh%20vn%201_ktt%2020.12_kienthuc_lziu.jpg"
                                                alt="Doanh nghiệp" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Thời gian tạo</label>
                                    <input type="text" class="form-control" name="created_at" value="Thời gian tạo"
                                        disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày hết hạn</label>
                                    <input type="text" class="form-control" name="end_date" value="Ngày hết hạn"
                                        disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lần cuối cập nhật</label>
                                    <input type="text" class="form-control" name="updated_at"
                                        value="Lần cuối cập nhật" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skill yêu cầu</label>
                                    <input type="text" class="form-control" name="skills" value="Skill" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Chuyên ngành yêu cầu</label>
                                    <input type="text" class="form-control" name="major_name" value="Chuyên ngành"
                                        disabled>
                                </div>
                            </div>

                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nội dung bài đăng</label>
                                    <div class="content"
                                        style="max-height: 800px; overflow-y: auto; background-color: #E6EBEE; border-radius: 10px; padding: 10px; color: #333333; font-weight: normal;">
                                        <!-- Nội dung HTML của bạn sẽ được đưa vào đây -->
                                        <div class="mb-3 detailJobs">
                                            <p><strong>Tiêu đề:</strong> Bài đăng mẫu</p>
                                            <p><strong>Nội dung:</strong> Đây là <strong>nội dung bài đăng</strong>, có thể
                                                chứa các thẻ HTML như <em>mã nguồn</em>, <strong>in đậm</strong>, và các thẻ
                                                khác.</p>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id">
                        <input type="hidden" name="status">
                    </form>
                </div>
                <div class="modal-footer" id="buttonSubmit" hidden>
                    <button type="button" class="btn btn-success" id="btnSubmit">Phê duyệt</button>
                    <button type="button" class="btn btn-danger" id="btnReject">Từ chối</button>
                    <script></script>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bắt sự kiện khi nhấn vào nút "Chi tiết"
            document.querySelectorAll('.btn-show-details').forEach(function(button) {
                button.addEventListener('click', function() {
                    var jobSlug = this.getAttribute(
                    'data-slug'); // Lấy slug của bài đăng từ thuộc tính data-slug
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
                    fetch(`{{ route('admin.jobs.slug', ':slug') }}`.replace(':slug', jobSlug))
                        .then(function(response) {
                            return response.json(); // Chuyển đổi kết quả thành JSON
                        })
                        .then(function(data) {

                            function getDate(data) {
                                const formatted_datetime = new Date(data).toLocaleString(
                                    'vi-VN', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    });
                                return formatted_datetime
                            }
                            if (data.message) return Toast.fire({
                                icon: "error",
                                title: "Lỗi: " + data.message
                            });
                            data = data.data
                            // Đổ dữ liệu vào modal
                            document.querySelector('#detailsModal input[name="name"]').value =
                                data.name;
                            document.querySelector('#detailsModal input[name="company_name"]')
                                .value = data.company_name;
                            document.querySelector(
                                    '#detailsModal img[id="company_avatar_path"]').src = data
                                .company_avatar_path;
                            document.querySelector('#detailsModal input[name="created_at"]')
                                .value = getDate(data.created_at);
                            document.querySelector('#detailsModal input[name="end_date"]')
                                .value = data.end_date;
                            document.querySelector('#detailsModal input[name="updated_at"]')
                                .value = getDate(data.updated_at);
                            document.querySelector('#detailsModal input[name="skills"]').value =
                                data.skills;
                            document.querySelector('#detailsModal input[name="major_name"]')
                                .value = data.major_name;
                            document.querySelector('#detailsModal input[name="id"]').value =
                                data.id;

                            // Đổ nội dung bài đăng vào content
                            document.querySelector('#detailsModal .detailJobs').innerHTML = data
                                .detail;

                            document.querySelector('#detailsModal #buttonSubmit').hidden = data
                                .status != {{STATUS_PENDING}};

                            $('#detailsModal').modal('show');
                        })
                        .catch(function(error) {
                            console.error('Error:', error);

                            Toast.fire({
                                icon: "error",
                                title: "Lỗi: " + error.message
                            });
                        });
                });
            });

            function submitForm(vl) {
                let form = document.getElementById('jobForm');

                // Cập nhật action của form tùy theo nút đã nhấn
                document.querySelector('#detailsModal input[name="status"]').value = vl;

                form.submit(); // Gửi form
            }

            document.getElementById('btnSubmit').addEventListener('click', function() {
                submitForm('1');
            })

            document.getElementById('btnReject').addEventListener('click', function() {
                submitForm('2');
            });
        });
    </script>


@endsection
