@extends('client.layout.main')
@section('title',  $job->name ?? 'Chi tiết tuyển dụng' )

@section('content')
    <div class="jp_img_wrapper">
        <div class="jp_slide_img_overlay"></div>
        <div class="jp_banner_heading_cont_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 py-5">
                        <div class="jp_tittle_heading_wrapper">
                            <div class="jp_tittle_heading">
                                <h2>{{ $job->name ?? 'Underfined' }}</h2>
                            </div>
                            <div class="jp_tittle_breadcrumb_main_wrapper">
                                <div class="jp_tittle_breadcrumb_wrapper">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i></li>
                                        <li><a href="{{ route('home') }}">Công việc mới</a> <i
                                                class="fa fa-angle-right"></i></li>
                                        <li>{{ $job->name ?? 'Underfined' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jp_listing_single_main_wrapper">
        <style>
            body {
                background-color: #f5f7fa;
            }
            .job-header {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 20px;
            }
            .job-header h1 {
                font-size: 24px;
                font-weight: bold;
            }
            .job-header .badge {
                font-size: 14px;
                margin-right: 10px;
            }
            .job-header .btn {
                margin-right: 10px;
            }
            .job-details, .sidebar {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
            }
            .sidebar .list-group-item {
                border: none;
                padding: 10px 0;
            }
            .sidebar .list-group-item i {
                margin-right: 10px;
            }
            .sidebar .list-group-item span {
                font-weight: bold;
            }
            .sidebar .related-jobs .list-group-item {
                padding: 15px 0;
            }
            .sidebar .related-jobs .list-group-item img {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }
        </style>
    
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job-header">
                        <h1>Senior PHP Developer (Laravel) | Mức Lương Lên Đến Gần 40 Triệu/Tháng Tại Hà Nội</h1>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success">Mức lương</span>
                            <span class="badge bg-primary">Địa điểm</span>
                            <span class="badge bg-warning">Kinh nghiệm</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="me-3"><i class="fas fa-dollar-sign"></i> 30 - 39 triệu</span>
                            <span class="me-3"><i class="fas fa-map-marker-alt"></i> Hà Nội</span>
                            <span class="me-3"><i class="fas fa-briefcase"></i> 2 năm</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <button class="btn btn-success me-2">Ứng tuyển ngay</button>
                            <button class="btn btn-outline-secondary">Lưu tin</button>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="me-3"><i class="fas fa-eye"></i> Xem số người đã ứng tuyển</span>
                            <span class="me-3"><i class="fas fa-calendar-alt"></i> Hạn nộp hồ sơ: 24/01/2025</span>
                        </div>
                    </div>
                    <div class="job-details">
                        <h2>Chi tiết tin tuyển dụng</h2>
                        <h3>Mô tả công việc</h3>
                        <ul>
                            <li>Phát triển các sản phẩm và dịch vụ dành cho nền tảng tuyển dụng PrepEdu.com</li>
                            <li>Phát triển tính năng mới và cải tiến, nâng cấp API dành cho các ứng dụng Mobile &amp; App Prep</li>
                            <li>Tham gia vào các giai đoạn phân tích, thiết kế, phát triển và kiểm thử hệ thống cho các sản phẩm / dịch vụ của công ty</li>
                            <li>Phối hợp với các bộ phận khác để triển khai các tính năng mới của sản phẩm</li>
                            <li>Thực hiện các công việc khác theo sự phân công của quản lý</li>
                        </ul>
                        <h3>Yêu cầu ứng viên</h3>
                        <ul>
                            <li>Tốt nghiệp từ 1-2 năm kinh nghiệm trong việc phát triển phần mềm</li>
                            <li>Có kinh nghiệm về Backend Developer sử dụng PHP/Laravel Framework</li>
                            <li>Có kinh nghiệm về DB, Laravel &amp; REST API</li>
                            <li>Có kinh nghiệm làm việc với các hệ thống lớn, có khả năng làm việc độc lập và làm việc nhóm tốt</li>
                            <li>Có kinh nghiệm làm việc với các công cụ quản lý mã nguồn như Git, SVN</li>
                            <li>Có kinh nghiệm làm việc với các công cụ CI/CD, Docker, Kubernetes là một lợi thế</li>
                        </ul>
                        <h3>Quyền lợi</h3>
                        <ul>
                            <li>Mức lương: 30.000.000 - 35.000.000đ / tháng (gross)</li>
                            <li>Thưởng: 1.000.000 - 4.000.000đ / tháng</li>
                            <li>Được tham gia các khóa học nâng cao kỹ năng</li>
                            <li>Được tham gia các hoạt động team building, du lịch hàng năm</li>
                            <li>Được làm việc trong môi trường trẻ trung, năng động</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="list-group mb-4">
                            <div class="list-group-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Phân tích mức độ phù hợp</span>
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-dollar-sign"></i>
                                Mức lương: 30 - 39 triệu
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-map-marker-alt"></i>
                                Địa điểm: Hà Nội
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-briefcase"></i>
                                Kinh nghiệm: 2 năm
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-user"></i>
                                Số lượng tuyển: 1 người
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-clock"></i>
                                Hình thức làm việc: Toàn thời gian
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-graduation-cap"></i>
                                Cấp bậc: Senior
                            </div>
                            <div class="list-group-item">
                                <i class="fas fa-briefcase"></i>
                                Giới tính: Không yêu cầu
                            </div>
                        </div>
                        <div class="related-jobs">
                            <h4>Danh mục Nghề liên quan</h4>
                            <div class="list-group">
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="https://placehold.co/50x50" alt="Job 1">
                                    <div>
                                        <h5 class="mb-1">JavaScript Developer</h5>
                                        <small>Công ty ABC</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="https://placehold.co/50x50" alt="Job 2">
                                    <div>
                                        <h5 class="mb-1">NodeJS Developer</h5>
                                        <small>Công ty XYZ</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="https://placehold.co/50x50" alt="Job 3">
                                    <div>
                                        <h5 class="mb-1">ReactJS Developer</h5>
                                        <small>Công ty DEF</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="related-jobs mt-4">
                            <h4>Kỹ năng cần có</h4>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <i class="fas fa-code"></i>
                                    PHP
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-database"></i>
                                    MySQL
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-code"></i>
                                    Laravel
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-code"></i>
                                    REST API
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-code"></i>
                                    JavaScript
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-code"></i>
                                    HTML/CSS
                                </div>
                            </div>
                        </div>
                        <div class="related-jobs mt-4">
                            <h4>Khu vực</h4>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Hà Nội
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    TP. Hồ Chí Minh
                                </div>
                                <div class="list-group-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Đà Nẵng
                                </div>
                            </div>
                        </div>
                        <div class="related-jobs mt-4">
                            <h4>Gợi ý việc làm phù hợp</h4>
                            <div class="list-group">
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="https://placehold.co/50x50" alt="Job 4">
                                    <div>
                                        <h5 class="mb-1">JavaScript Developer</h5>
                                        <small>Công ty ABC</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="https://placehold.co/50x50" alt="Job 5">
                                    <div>
                                        <h5 class="mb-1">NodeJS Developer</h5>
                                        <small>Công ty XYZ</small>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center">
                                    <img src="https://placehold.co/50x50" alt="Job 6">
                                    <div>
                                        <h5 class="mb-1">ReactJS Developer</h5>
                                        <small>Công ty DEF</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_rightside_job_categories_heading">
                        <h4>Mô tả công việc</h4>
                    </div>
                    <div class="jp_listing_left_sidebar_wrapper">
                        <div class="jp_job_des">
                            <h2>Mô tả</h2>
                            <div>{!! $job->detail ?? '' !!}</div>
                        </div>

                        <div class="jp_job_apply">
                            <h2>Ứng tuyển</h2>
                            <p>Vui lòng gửi CV về theo website công ty: <a href="{{ $job->company->website_link }}"><strong>{{ $job->company->name ?? '' }}</strong></a>.</p>
                        </div>
                        <div class="jp_job_map">
                            <h2>Địa chỉ</h2>
                            <div id="map" style="width:100%; float:left; height:300px;">
                                @if (!empty($company->address))
                                    <iframe width="100%" height="300" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade" style="border:0"
                                        src="https://www.google.com/maps?q={{ $company->address }}&output=embed"
                                        allowfullscreen>
                                    </iframe>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="jp_listing_left_bottom_sidebar_key_wrapper">
                        <ul>
                            <li><i class="fa fa-tags"></i>Chuyên ngành :</li>
                            @foreach ($company->fields as $field)
                                <li><a href="#">{{ $field->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Thông tin chung</h4>
                                </div>
                                <div class="jp_jop_overview_img_wrapper">
                                    <div class="jp_jop_overview_img">
                                        <img src="{{ asset($job->company->avatar_path) }}" alt="post_img" />
                                    </div>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont">
                                    <div class="jp_job_listing_single_post_right_cont_wrapper">
                                        <h4>{{ $job->name ?? 'Underfined' }}</h4>
                                    </div>
                                </div>

                                <div class="jp_listing_overview_list_outside_main_wrapper">
                                    <div class="jp_listing_overview_list_main_wrapper">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Hạn nộp hồ sơ</li>
                                                <li>{{ $job->end_date ? \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') : 'Undefined' }}
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Website </li>
                                                <li><a href="{{ $job->company->website_link ?? 'Underfined' }}">{{ $job->company->website_link ?? 'Underfined' }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Địa điểm:</li>
                                                <li>{{ $company->address ?? 'Không có' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Kỹ năng:</li>
                                                @foreach ($job->skills as $skill)
                                                <li><i class="fa-solid fa-caret-right" style="color: #f00000;"></i>&nbsp;&nbsp; {{ $skill->name }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Cấp bậc:</li>
                                                <li>Thực tập sinh</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="jp_listing_right_bar_btn_wrapper">
                                        <div class="jp_listing_right_bar_btn">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-plus-circle"></i> &nbsp;Ứng tuyển</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    
@endsection
