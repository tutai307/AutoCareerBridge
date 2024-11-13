@extends('management.layout.main')

@section('title', 'Danh sách bài đăng')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Thống kê</a></li>
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
                    <form method="GET" action="http://127.0.0.1:8000/admin/users">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6">
                                    <label class="form-label">Tên job hoặc tên doanh nghiệp</label>
                                    <input type="text" class="form-control mb-xl-0 mb-3" name="search" value=""
                                           placeholder="Tìm kiếm...">
                                </div>

                                <div class="col-xl-2 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">Trạng thái</label>
                                    <div class="dropdown bootstrap-select form-control default-select h-auto wide">
                                        <select name="active" class="form-control default-select h-auto wide">
                                            <option value="all">Chọn trạng thái</option>
                                            <option value="0">Chờ phê duyệt</option>
                                            <option value="1">Đã phê duyệt</option>
                                            <option value="2">Từ chối</option>
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
                                        <select name="active" class="form-control default-select h-auto wide">
                                            <option value="all">Chọn chuyên ngành</option>
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
                                        <button class="btn btn-danger light" title="Click here to remove filter"
                                                type="button"
                                                onclick="window.location.href='{{route('admin.jobs.index')}}'">
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

                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Doanh nghiệp</th>
                                <th>Chuyên ngành yêu cầu</th>
                                <th>Ngày đăng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td><strong>542</strong></td>
                                <td>
                                    <span class="w-space-no">Jackson</span>
                                </td>
                                <td>JVB</td>
                                <td>IT</td>
                                <td>01/12/2020</td>
                                <td>
                                    <div class="d-flex align-items-center"><i
                                            class="fa fa-circle text-success me-1"></i> Đã duyệt
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <a href="{{route('admin.jobs.edit', '1')}}" class="btn btn-primary shadow btn-xs ">
                                            <i class="fa-solid fa-file-alt"></i> Chi tiết
                                        </a>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td><strong>542</strong></td>
                                <td>
                                    <span class="w-space-no">Jackson</span>
                                </td>
                                <td>JVB</td>
                                <td>IT</td>
                                <td>01/12/2020</td>
                                <td>
                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i>
                                        Đã từ chối
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <a href="{{route('admin.jobs.edit', '1')}}" class="btn btn-primary shadow btn-xs ">
                                            <i class="fa-solid fa-file-alt"></i> Chi tiết
                                        </a>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td><strong>542</strong></td>
                                <td>
                                    <span class="w-space-no">Jackson</span>
                                </td>
                                <td>JVB</td>
                                <td>IT</td>
                                <td>01/12/2020</td>
                                <td>
                                    <div class="d-flex align-items-center"><i
                                            class="fa fa-circle text-warning me-1"></i> Chờ phê duyệt
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <a href="#" class="btn btn-primary shadow btn-xs" data-bs-toggle="modal" data-bs-target="#detailsModal">
                                            <i class="fa-solid fa-file-alt"></i> Chi tiết
                                        </a>
                                    </div>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <form action="{{ route('admin.jobs.update', '1') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài đăng</label>
                                    <input type="text" class="form-control" value="Tiêu đề bài đăng" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Doanh nghiệp</label>
                                    <div class="d-flex flex-column">
                                        <!-- Trường Doanh nghiệp -->
                                        <input type="text" class="form-control mb-2" value="Tên doanh nghiệp" disabled>
                                        <!-- Ảnh Doanh nghiệp -->
                                        <div>
                                            <img src="https://images.kienthuc.net.vn/zoom/800/uploaded/hongnhat/2013_12_20/anh%20vn%201_ktt%2020.12_kienthuc_lziu.jpg" alt="Doanh nghiệp" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Thời gian tạo</label>
                                    <input type="text" class="form-control" value="Thời gian tạo" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày hết hạn</label>
                                    <input type="text" class="form-control" value="Ngày hết hạn" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lần cuối cập nhật</label>
                                    <input type="text" class="form-control" value="Lần cuối cập nhật" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skill yêu cầu</label>
                                    <input type="text" class="form-control" value="Skill" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Chuyên ngành yêu cầu</label>
                                    <input type="text" class="form-control" value="Chuyên ngành" disabled>
                                </div>
                            </div>

                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nội dung bài đăng</label>
                                    <div class="content" style="max-height: 800px; overflow-y: auto; background-color: #E6EBEE; border-radius: 10px; padding: 10px; color: #333333; font-weight: normal;">
                                        <!-- Nội dung HTML của bạn sẽ được đưa vào đây -->
                                        <div class="mb-3">
                                            <p><strong>Tiêu đề:</strong> Bài đăng mẫu</p>
                                            <p><strong>Nội dung:</strong> Đây là <strong>nội dung bài đăng</strong>, có thể chứa các thẻ HTML như <em>mã nguồn</em>, <strong>in đậm</strong>, và các thẻ khác.</p>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Phê duyệt</button>
                    <button type="button" class="btn btn-danger">Từ chối</button>
                </div>
            </div>
        </div>
    </div>

@endsection
