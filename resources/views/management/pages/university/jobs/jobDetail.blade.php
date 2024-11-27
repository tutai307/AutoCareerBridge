@extends('management.layout.main')
@section('content')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết bài đăng</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Chi tiết bài đăng -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chi tiết bài đăng</h5>
                </div>
                <div class="card-body">
                    <form action="" id="jobForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <!-- Cột bên trái -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tiêu đề bài đăng</label>
                                    <input type="text" class="form-control" name="name" value="Tiêu đề bài đăng" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Doanh nghiệp</label>
                                    <div class="d-flex flex-column">
                                        <!-- Trường Doanh nghiệp -->
                                        <input type="text" class="form-control mb-2" name="company_name" value="Tên doanh nghiệp" disabled>
                                        <!-- Ảnh Doanh nghiệp -->
                                        <div>
                                            <img id="company_avatar_path" src="https://images.kienthuc.net.vn/zoom/800/uploaded/hongnhat/2013_12_20/anh%20vn%201_ktt%2020.12_kienthuc_lziu.jpg" alt="Doanh nghiệp" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Thời gian tạo</label>
                                    <input type="text" class="form-control" name="created_at" value="Thời gian tạo" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ngày hết hạn</label>
                                    <input type="text" class="form-control" name="end_date" value="Ngày hết hạn" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lần cuối cập nhật</label>
                                    <input type="text" class="form-control" name="updated_at" value="Lần cuối cập nhật" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Skill yêu cầu</label>
                                    <input type="text" class="form-control" name="skills" value="Skill" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Chuyên ngành yêu cầu</label>
                                    <input type="text" class="form-control" name="major_name" value="Chuyên ngành" disabled>
                                </div>
                            </div>

                            <!-- Cột bên phải -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nội dung bài đăng</label>
                                    <div class="content" style="max-height: 800px; overflow-y: auto; background-color: #E6EBEE; border-radius: 10px; padding: 10px; color: #333333; font-weight: normal;">
                                        <!-- Nội dung HTML của bạn sẽ được đưa vào đây -->
                                        <div class="mb-3 detailJobs">
                                            <p><strong>Tiêu đề:</strong> Bài đăng mẫu</p>
                                            <p><strong>Nội dung:</strong> Đây là <strong>nội dung bài đăng</strong>, có thể chứa các thẻ HTML như <em>mã nguồn</em>, <strong>in đậm</strong>, và các thẻ khác.</p>
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
                <div class="card-footer text-end" id="buttonSubmit" >
                    <button type="button" class="btn btn-light" id="btnReject">Bỏ qua</button>
                    <button type="button" class="btn btn-primary" id="btnSubmit">Ứng tuyển</button>
                </div>
            </div>
        </div>
    </div>
@endsection
