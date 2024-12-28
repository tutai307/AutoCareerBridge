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
                                        <li><a href="{{ route('home') }}">Trang chủ</a> <i class="fa fa-angle-right"></i></li>
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
                    {{ $job->name ?? 'Underfined' }}
                </h1>
                {{-- <div class="flex items-center space-x-4 mb-4">
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
                </div> --}}
                <div class="flex items-center space-x-4 mb-4">
                    <span>Hạn nộp hồ sơ:
                        {{ $job->end_date ? \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') : 'Undefined' }}</span>
                </div>
                <div class="flex items-center space-x-4 mb-4">
                    @php
                        $university =
                            auth()->guard('admin')->user()->university ??
                            (auth()->guard('admin')->user()->academicAffair->university ?? null);
                        $jobUniversityStatus = null;
                        if ($university) {
                            $jobUniversityStatus = $university
                                ->universityJobs()
                                ->where('job_id', $job->id)
                                ->first();
                        }
                    @endphp

                    @if ($university)
                        @if (!$jobUniversityStatus)
                            <button id="joinButton"
                                data-url="{{ route('university.job.apply', ['job_id' => $job->id, 'university_id' => $university->id]) }}"
                                class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg">
                                <i class="fa fa-plus-circle"></i> &nbsp;Ứng tuyển ngay
                            </button>
                        @elseif ($jobUniversityStatus)
                            <button class="bg-gray-400 text-white px-4 py-2 rounded-lg" disabled>
                                <i class="fa fa-check-circle"></i> &nbsp;Đã gửi yêu cầu
                            </button>
                        @endif
                    @endif

                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-4">Chi tiết tin tuyển dụng</h2>
                    <div class="card-body">
                        {!! $job->detail ?? '' !!}
                    </div>
                    <p class="mb-4">Hạn nộp hồ sơ:
                        {{ $job->end_date ? \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') : 'Undefined' }}</p>

                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p class="text-gray-700">Báo cáo tin tuyển dụng: Nếu bạn thấy tin tuyển dụng này không đúng hoặc có
                            dấu hiệu lừa đảo, hãy phản ánh với chúng tôi.</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center space-x-4 mb-4">
                            <img alt="Company logo" class="w-12 h-12 rounded-full" height="50"
                                src="{{ $job->company->avatar_path ? asset($job->company->avatar_path) : 'https://storage.googleapis.com/a1aa/image/s5BVY4OnMA5mHRcUdNNzyQE9LpotgfNIsuDivAe1LedJgv8nA.jpg' }}"
                                width="50" />
                            <div>
                                <h3 class="text-lg font-bold">{{ $job->company->name ?? '' }}</h3>
                                <p class="text-gray-700">{{ $job->company->size }} nhân viên</p>
                                <p class="text-gray-700">
                                    {{ implode(' / ', $company->fields->pluck('name')->toArray()) }}
                                </p>
                                <p class="text-gray-700">{{ $company->address }}</p>
                            </div>
                        </div>

                        <button class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg w-full"
                            onclick="window.location.href='{{ $job->company->website_link }}'">Xem trang công ty</button>
                    </div>
                    {{-- <div class="bg-white p-6 rounded-lg shadow-md">
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
                    </div> --}}
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold mb-4">Kỹ năng cần có</h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach ($job->skills as $skill)
                                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-lg font-bold mb-4">Khu vực</h3>
                        <ul class="space-y-2">
                            <li class="text-blue-500">{{ $company->district }} / {{ $company->province }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .card-body {
            font-family: "Inter", serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
            border-radius: 8px;
        }

        .card-body h1,
        .card-body h2,
        .card-body h3,
        .card-body h4 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card-body h1 {
            font-size: 2rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .card-body h2 {
            font-size: 1.75rem;
            border-bottom: 1px solid #2980b9;
            padding-bottom: 3px;
        }

        .card-body h3 {
            font-size: 1.5rem;
        }

        .card-body p {
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .card-body ul,
        .card-body ol {
            margin-left: 20px;
            margin-bottom: 20px;
        }

        .card-body ul li,
        .card-body ol li {
            margin-bottom: 10px;
        }

        .card-body ul li::marker {
            color: #3498db;
        }

        .card-body ol li {
            color: #2980b9;
        }

        .card-body table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-body table th,
        .card-body table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .card-body table th {
            background-color: #3498db;
            color: #fff;
        }

        .card-body table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .card-body img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 5px;
        }

        .card-body blockquote {
            font-style: italic;
            color: #555;
            border-left: 4px solid #3498db;
            margin: 15px 0;
            padding-left: 10px;
        }

        .card-body pre {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
            font-family: 'Courier New', Courier, monospace;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px !important;
            margin: 0 auto !important;
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#joinButton', function(e) {
            e.preventDefault();
            let btnThis = $(this)
            var joinUrl = $(this).data('url');
            $.ajax({
                url: joinUrl,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    action: 'join'
                },
                success: function(response) {
                    btnThis.html('<i class="fa fa-check-circle"></i> &nbsp;Đã gửi yêu cầu')
                        .addClass('bg-gray-400')
                        .removeClass('bg-blue-500')
                        .prop('disabled', true);
                    toastr.success("", "Yêu cầu ứng tuyển đã được gửi!")

                    // setTimeout(function() {
                    //     location.reload();
                    // }, 2000);
                },
                error: function(xhr, status, error) {
                    toastr.error("", "" + error.message);
                }
            });
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endsection
