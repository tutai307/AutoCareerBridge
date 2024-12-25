@extends('client.layout.main')
@section('title', 'Chi tiết workshop')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: none;
            font-weight: bold;
            font-size: 1.25rem;
        }

        .card-body {
            background-color: #fff;
        }

        .btn-apply {
            background-color: #28a745;
            color: #fff;
        }

        .btn-apply:hover {
            background-color: #218838;
        }

        .btn-save {
            background-color: #fff;
            color: #28a745;
            border: 1px solid #28a745;
        }

        .btn-save:hover {
            background-color: #e9ecef;
        }

        .icon-text {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .icon-text i {
            margin-right: 10px;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .company-info {
            display: flex;
            align-items: center;
        }

        .company-info img {
            margin-right: 10px;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .section-content {
            margin-bottom: 20px;
        }

        .section-content ul {
            padding-left: 20px;
        }

        .section-content ul li {
            list-style-type: disc;
        }
    </style>

    <div class="jp_img_wrapper">
        <div class="jp_slide_img_overlay"></div>
        <div class="jp_banner_heading_cont_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 py-5">
                        <div class="jp_tittle_heading_wrapper">
                            <div class="jp_tittle_heading">
                                <h2>{{ $workshop->name }}</h2>
                            </div>
                            <div class="jp_tittle_breadcrumb_main_wrapper">
                                <div class="jp_tittle_breadcrumb_wrapper">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i></li>
                                        <li><a href="{{ route('home') }}">Công việc mới</a> <i
                                                class="fa fa-angle-right"></i></li>
                                        <li>{{ $workshop->name ?? 'Underfined' }}</li>
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
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            {{ $workshop->name ?? 'Undefined' }}
                        </div>
                        <div class="card-body">
                            <div class="icon-text">
                                <i class="fa-solid fa-clock" style="color: #ff5353;"></i>
                                <span>Bắt đầu: {{ $workshop->start_date }}</span>
                            </div>
                            <div class="icon-text">
                                <i class="fa-solid fa-clock" style="color: #ff5353;"></i>
                                <span>Kết thúc: {{ $workshop->end_date }}</span>
                            </div>
                            <div class="icon-text">
                                <i class="fa-solid fa-user-friends" style="color: #ff5353;"></i>
                                <span>Số lượng: {{ $workshop->amount }} người</span>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
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
                                        <button class="btn btn-primary" id="joinButton"
                                            data-url="{{ route('company.workshop.apply', ['companyId' => $company->id, 'workshopId' => $workshop->id]) }}">
                                            Tham gia ngay
                                        </button>
                                    @else
                                        <button class="btn btn-primary" disabled>Đã gửi yêu cầu tham gia</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body">

                            <div class="section-content">
                                <div class="section-title">Mô tả workshop</div>
                                <p>{!! $workshop->content !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="company-info">
                                <img alt="Company logo" class="company-logo" height="100"
                                    src="{{ isset($workshop->university->avatar_path) ? asset('storage/' . $workshop->university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                    width="50" />
                                <div>
                                    <div class="fw-bold">{{ $workshop->university->name ?? 'Undefined' }}</div>
                                    <a style="color: #007bff; text-decoration: none;"
                                        href="{{ route('detailUniversity', $workshop->university->slug) }}" target="_blank"
                                        onmouseover="this.style.textDecoration='underline'; this.style.color='#0056b3';"
                                        onmouseout="this.style.textDecoration='none'; this.style.color='#007bff';">
                                        Xem trang công ty <i class="fas fa-external-link-alt"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="section-title">Thông tin chung</div>
                            <div class="icon-text">
                                <div class="jp_listing_list_icon">
                                    <i class="fa-solid fa-location-dot me-2" style="color: #ff5353;"></i>
                                </div>
                                <span>{{ $workshop->university->address->specific_address }},
                                    {{ $workshop->university->address->ward ? $workshop->university->address->ward->name . ', ' : '' }}
                                    {{ $workshop->university->address->district ? $workshop->university->address->district->name . ', ' : '' }}
                                    {{ $workshop->university->address->province ? $workshop->university->address->province->name : '' }}
                                </span>
                            </div>
                            
                            <div class="icon-text">
                                <i class="fa-solid fa-circle-info"></i>
                                <span id="statusText">Trạng thái:
                                    <span style="color: {{ $workshopStatus ? '#28a745' : '#007bff' }};">
                                        {{ $workshopStatus ? 'Đã tham gia' : 'Chưa tham gia' }}
                                    </span>
                                </span>
                            </div>
                        </div>
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
                    btnThis.text('Đã gửi yêu cầu tham gia').prop('disabled', true);
                    $('#statusText').text('Trạng thái: Đã tham gia');
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Yêu cầu tham gia đã được gửi đến trường học!"
                    });
                },
                error: function(xhr, status, error) {
                    alert('Lỗi yêu cầu Ajax!');
                }
            });
        });
    </script>
@endsection
