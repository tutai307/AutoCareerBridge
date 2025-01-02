@extends('client.layout.main')
@section('title', $workshop->name ?? 'Chi tiết workshop')

@section('content')
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
            font-size: 1.45rem;
            border-bottom: 1px solid #2980b9;
            padding-bottom: 3px;
        }

        .card-body h3 {
            font-size: 1.2rem;
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

<div class="jp_img_wrapper">
    <div class="jp_slide_img_overlay"></div>
    <div class="jp_banner_heading_cont_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 py-5">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>{{ $workshop->name ?? 'Chi tiết workshop' }}</h2>
                        </div>
                        <div class="jp_tittle_breadcrumb_main_wrapper">
                            <div class="jp_tittle_breadcrumb_wrapper">
                                <ul>
                                    <li><a href="{{ route('home') }}">Trang chủ</a> <i class="fa fa-angle-right"></i>
                                    <li><a href="{{ route('workshop') }}">Workshop</a> <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li>{{ Str::limit($workshop->name, 100) }}</li>
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
            <h1 class="text-2xl font-bold mb-2 break-words">
                {{ $workshop->name ?? 'Undefined' }}
            </h1>
            <div class="flex items-center space-x-4 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-clock text-red-500"></i>
                    <span class="ml-2">Bắt đầu: {{ $workshop->start_date }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock text-red-500"></i>
                    <span class="ml-2">Kết thúc: {{ $workshop->end_date }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-user-friends text-red-500"></i>
                    <span class="ml-2">Số lượng: {{ $workshop->amount }} doanh nghiệp</span>
                </div>
            </div>
            <div class="flex items-center space-x-4 mb-4">
                <span>Hạn đăng ký: {{ $workshop->end_date }}</span>
            </div>
            <div class="flex items-center space-x-4 mb-4">
                @php
                    $company =
                        auth()->guard('admin')->user()->company ??
                        (auth()->guard('admin')->user()->hiring->company ?? null);
                    $workshopStatus = $company
                        ? $company
                            ->companyworkshops()
                            ->where('workshop_id', $workshop->id)
                            ->first()
                        : null;
                @endphp
                @if ($company)
                    @if (!$workshopStatus)
                        @if ($workshop->end_date > now())
                            <button class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg" id="joinButton"
                                data-url="{{ route('company.workshop.apply', ['companyId' => $company->id, 'workshopId' => $workshop->id]) }}">
                                Tham gia ngay
                            </button>
                        @else
                            <button class="bg-yellow-200 text-black px-4 py-2 rounded-lg" disabled>
                                Đã hết hạn đăng ký
                            </button>
                        @endif
                    @elseif ($workshopStatus->workshops->amount == $countCompany)
                        <button class="bg-yellow-200 text-black px-4 py-2 rounded-lg" disabled>Đã đủ doanh nghiệp
                            tham gia </button>
                    @else
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg" disabled>Đã gửi yêu cầu tham
                            gia</button>
                    @endif
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Mô tả workshop</h2>
                <div class="card-body">
                    {!! $workshop->content ?? '' !!}
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center space-x-4 mb-4">
                        <img alt="Company logo" class="w-12 h-12 rounded-full" height="50"
                            src="{{ isset($workshop->university->avatar_path) ? asset('storage/' . $workshop->university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                            width="50" />
                        <div>
                            <h3 class="text-lg font-bold">{{ $workshop->university->name ?? 'Undefined' }}</h3>
                            <p class="text-gray-700">{{ $workshop->university->students->count() }} sinh viên</p>
                        </div>
                    </div>
                    <a href="{{ route('detailUniversity', $workshop->university->slug) }}" target="_blank"
                        class="text-[#23c0e9]"> <button class="bg-[#23c0e9] text-white px-4 py-2 rounded-lg w-full">Xem
                            trang trường học</button></a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold mb-4">Thông tin chung</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            <span class="ml-2">{{ $workshop->university->address->specific_address }},
                                {{ $workshop->university->address->ward ? $workshop->university->address->ward->name . ', ' : '' }}
                                {{ $workshop->university->address->district ? $workshop->university->address->district->name . ', ' : '' }}
                                {{ $workshop->university->address->province ? $workshop->university->address->province->name : '' }}
                            </span>
                        </li>
                        @if ($company)
                            <li class="flex items-center">
                                <i class="fas fa-circle-info"></i>
                                <span id="statusText">Trạng thái:
                                    <span
                                        style="color: {{ $workshopStatus === null ? '#ffc107' : ($workshopStatus->status === 1 ? '#ffc107' : ($workshopStatus->status === 2 ? '#28a745' : '#dc3545')) }};">
                                        {{ $workshopStatus === null ? 'Chưa tham gia' : ($workshopStatus->status === 1 ? 'Đang chờ phê duyệt' : ($workshopStatus->status === 2 ? 'Đã tham gia' : 'Đã bị từ chối')) }}
                                    </span>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '#joinButton', function(e) {
        e.preventDefault();
        let btnThis = $(this);
        var joinUrl = $(this).data('url');
        $.ajax({
            url: joinUrl,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                action: 'join'
            },
            success: function(response) {
                btnThis.css('background-color', '#999').text('Đã gửi yêu cầu tham gia').prop(
                    'disabled', true);
                $('#statusText')
                    .html(
                        'Trạng thái: <span style="color: #ffc107;">Chờ phê duyệt</span>'
                    ); // Thêm màu cho 'Đã tham gia'
                toastr.success("", "Yêu cầu đã được gửi thành công!");
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
