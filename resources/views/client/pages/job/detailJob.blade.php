@extends('client.layout.main')
@section('title', $job->name ?? 'Chi tiết tuyển dụng')

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

        <div class="max-w-7xl mx-auto p-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-2">
                    Senior PHP Developer (Lavarel) | Mức Lương Lên Đến Gần 40 Triệu/Tháng Tại Hà Nội
                </h1>
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-dollar-sign text-[#23c0e9]"></i>
                        <span class="ml-2">30 - 39 triệu</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-[#23c0e9]"></i>
                        <span class="ml-2">Hà Nội</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-briefcase text-[#23c0e9]"></i>
                        <span class="ml-2">2 năm</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mb-4">
                    <span>Hạn nộp hồ sơ: 24/01/2025</span>
                </div>
                <div class="flex items-center space-x-4 mb-4">
                    <button class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg">Ứng tuyển ngay</button>
                    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Lưu tin</button>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Chi tiết tin tuyển dụng</h2>
                    {!! $job->detail ?? '' !!}
                    <h3 class="text-lg font-bold mb-2">Cách thức ứng tuyển</h3>
                    <p class="mb-4">Ứng viên nộp hồ sơ trực tuyến bằng cách bấm Ứng tuyển ngay dưới đây.</p>
                    <p class="mb-4">Hạn nộp hồ sơ: 24/01/2025</p>
                    <div class="flex items-center space-x-4 mb-4">
                        <button class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg">Ứng tuyển ngay</button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">Lưu tin</button>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-700">Báo cáo tin tuyển dụng: Nếu bạn thấy tin tuyển dụng này không đúng hoặc có
                            dấu hiệu lừa đảo, hãy phản ánh với chúng tôi.</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center space-x-4 mb-4">
                            <img alt="Company logo" class="w-12 h-12 rounded-full" height="50"
                                src="https://storage.googleapis.com/a1aa/image/s5BVY4OnMA5mHRcUdNNzyQE9LpotgfNIsuDivAe1LedJgv8nA.jpg"
                                width="50" />
                            <div>
                                <h3 class="text-lg font-bold">Công ty Cổ phần Công nghệ Prep</h3>
                                <p class="text-gray-700">100-499 nhân viên</p>
                                <p class="text-gray-700">Giáo dục / Đào tạo</p>
                                <p class="text-gray-700">Tầng 3 Tòa nhà Vinaconex 34 Láng Hạ</p>
                            </div>
                        </div>
                        <button class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg w-full">Xem trang công ty</button>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold mb-4">Thông tin chung</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-user text-[#23c0e9]"></i>
                                <span class="ml-2">Cấp bậc: Nhân viên</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-briefcase text-[#23c0e9]"></i>
                                <span class="ml-2">Kinh nghiệm: 2 năm</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-users text-[#23c0e9]"></i>
                                <span class="ml-2">Số lượng tuyển: 1 người</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-clock text-[#23c0e9]"></i>
                                <span class="ml-2">Hình thức làm việc: Toàn thời gian</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-graduation-cap text-[#23c0e9]"></i>
                                <span class="ml-2">Giới tính: Không yêu cầu</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold mb-4">Kỹ năng cần có</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                                Chuyên môn Backend Developer
                            </span>
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                                IT - Phần mềm
                            </span>
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                                IT - Phần cứng và máy tính
                            </span>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold mb-4">Khu vực</h3>
                        <ul class="space-y-2">
                            <li class="text-blue-500">Hà Nội</li>
                        </ul>
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

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .card-body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
            border-radius: 8px;
        }

        .card-body h6 {
            font-size: 18px;
            color: #333;
            margin-bottom: 12px;
            border-left: 4px solid #007bff;
            padding-left: 8px;
            font-weight: bold;
        }

        .card-body p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .card-body ul {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .card-body ul li {
            font-size: 15px;
            color: #444;
            margin-bottom: 10px;
            position: relative;
            padding-left: 20px;
        }

        .card-body ul li::before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            color: #007bff;
            position: absolute;
            left: 0;
            top: 2px;
        }

        .card-body strong {
            color: #d9534f;
            font-weight: bold;
        }

        .card-body p:last-child {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endsection
