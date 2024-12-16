@extends('client.layout.main')
@section('title', 'Chi tiết trường học')
@section('content')
    <div class="jp_tittle_main_wrapper">
        <div class="jp_tittle_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>Các trường học</h2>
                        </div>
                        <div class="jp_tittle_breadcrumb_main_wrapper">
                            <div class="jp_tittle_breadcrumb_wrapper">
                                <ul>
                                    <li><a href="{{ route('home') }}">Trang chủ</a> <i class="fa fa-angle-right"></i>
                                    </li>
                                    <li><a href="{{ route('listUniversity') }}">Trường học</a> <i
                                            class="fa fa-angle-right"></i></li>
                                    <li>Thông tin trường học</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jp_listing_single_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="jp_rightside_job_categories_heading">
                        <h4>Tổng quan trường học</h4>
                    </div>
                    <div class="jp_listing_left_sidebar_wrapper">

                        <div class="jp_job_des jp_job_qua">
                            <h2>Giới thiệu</h2>
                            <p>{!! $detail->description !!}</p>
                        </div>

                        <div class="jp_job_des jp_job_qua">
                            <h2>Mô tả</h2>
                            <p> {!! $detail->about !!}</p>

                        </div>
                        <div class="jp_job_des jp_job_qua">
                            <h2>Các ngành học</h2>
                            <ul>
                                @foreach ($majors as $major)
                                    <a href="" class="btn btn-primary light btn-xs mb-1">
                                        {{ $major->name }}
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                        <div class="jp_job_des jp_job_qua">
                            <h2>Thông tin trường học</h2>
                            <ul>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Tên trường <span class="pull-end">:</span>
                                        </h5>
                                    </div>
                                    <div class="col-sm-9 col-7"><span>{{ $detail->name }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                        </h5>
                                    </div>
                                    <div class="col-sm-9 col-7"><span>{{ $detail->user->email }}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Hotline <span class="pull-end">:</span></h5>
                                    </div>
                                    <div class="col-sm-9 col-7"><span>0971410801</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Quy mô <span class="pull-end">:</span>
                                        </h5>
                                    </div>
                                    <div class="col-sm-9 col-7"><span>{{ $detail->students->count() }} sinh viên</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Website<span class="pull-end">:</span></h5>
                                    </div>
                                    <div class="col-sm-9 col-7 text-break">
                                        <a href="{{ $detail->website_link }}">
                                            <span>{{ $detail->website_link }}</span>
                                        </a>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Thông tin liên hệ</h4>
                                </div>
                                <div class="jp_jop_overview_img_wrapper">
                                    <div class="jp_jop_overview_img">
                                        <img style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 50%;"
                                            src="{{ isset($detail->avatar_path) ? asset('storage/' . $detail->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                            alt="hiring_img" />
                                    </div>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont">
                                    <div class="jp_job_listing_single_post_right_cont_wrapper">
                                        <h4>{{ $detail->name }}</h4>
                                    </div>
                                    <div style="display: flex; justify-content:space-evenly;margin: 20px 0%">
                                        <div>
                                            <h3 class="m-b-0">{{ $detail->students->count() }}</h3>
                                            <p>Quy mô</p>
                                        </div>
                                        <div>
                                            <h3 class="m-b-0">{{ count($majors) }}</h3>
                                            <p>Ngành</p>
                                        </div>
                                        <div>
                                            <h3 class="m-b-0">{{ $detail->collaborations->count() }}</h3>
                                            <p>Liên kểt</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="jp_job_post_right_overview_btn_wrapper">
                                    <div class="jp_job_post_right_overview_btn">
                                        @if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === ROLE_COMPANY)
                                            @php
                                                $companyId = null;
                                                $isFollowed = false;
                                                $isPending = false;
                                                if (auth()->guard('admin')->check()) {
                                                    $user = auth()->guard('admin')->user();
                                                    if ($user && $user->company) {
                                                        $companyId = $user->company->id;
                                                        $isFollowed = $detail
                                                            ->collaborations()
                                                            ->where('status', 2)
                                                            ->where('company_id', $companyId)
                                                            ->exists();
                                                        $isPending = $detail
                                                            ->collaborations()
                                                            ->where('status', 1)
                                                            ->where('company_id', $companyId)
                                                            ->exists();
                                                    }
                                                }
                                            @endphp
                                            @if ($companyId)
                                                @if ($isPending)
                                                    <a class="btn btn-sm px-4 danger" href="#">
                                                        Hủy yêu cầu
                                                    </a>
                                                @elseif ($isFollowed)
                                                    <a class="btn btn-sm px-4 seccon" href="#">
                                                        Đang hợp tác
                                                    </a>
                                                @else
                                                    <button type="button" class="" data-toggle="modal"
                                                        data-target="#exampleModal">Yêu cầu hợp tác
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                </div>
                                <div class="col-xl-12">
                                    <div style="border-radius: 0;" class="card">
                                        <div class="card-body">
                                            <div class="profile-blog">
                                                <h5 class="text-primary d-inline">
                                                    <div class="jp_listing_list_icon">
                                                        <i class="fa fa-map-marker"></i>
                                                    </div>
                                                    Địa chỉ
                                                </h5>
                                                <p>{{ $full_address }}</p>
                                                <h5 class="text-primary d-inline">
                                                    Xem bản đồ</h5>
                                                <?php

                                                $encodedAddress = urlencode($full_address);
                                                ?>

                                                <div style="width: 100%; height: 400px;">
                                                    <iframe
                                                        src="https://www.google.com/maps?q=<?php echo $encodedAddress; ?>&output=embed"
                                                        width="100%" height="100%" style="border:0;" allowfullscreen=""
                                                        loading="lazy">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jp_listing_related_heading_wrapper">
                <h2>Work Shops</h2>
                <div class="jp_listing_related_slider_wrapper">
                    <div class="owl-carousel owl-theme">

                        @forelse($workshops as $workshop)
                            <div class="card mb-3" style="width: 100%; border: 1px solid #e8e8e7; border-radius: 8px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="thump-image--detail">
                                            <img style="width: 100%; height: 220px; background-size: contain; background-repeat: no-repeat; background-position: center;"
                                                src="{{ $workshop->avatar_path }}" class="img-fluid rounded-start"
                                                alt="{{ $workshop->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body" style="padding-bottom:10px;">
                                            <h3 style="overflow: hidden; height: 3.2em; text-overflow: ellipsis;"
                                                class="card-title">{{ $workshop->name }}</h3>
                                            <h5 style="padding-bottom: 10px" class="card-text" class="text-muted">
                                                <b>Số lượng:</b> {{ $workshop->amount }} người
                                            </h5>
                                            <h6 class="card-text" class="text-muted"><b>Thời gian bắt
                                                    đầu: </b>{{ $workshop->start_date }}</h6>
                                            <h6 class="py-2 card-text" class="text-muted"><b>Thời gian kết
                                                    thúc: </b>{{ $workshop->end_date }}</h6>
                                            <div class="d-flex justify-content-end mt-2">
                                                @php
                                                    $companyId = null;
                                                    if (auth()->guard('admin')->check()) {
                                                        $user = auth()->guard('admin')->user();
                                                        if ($user && $user->company) {
                                                            $companyId = $user->company->id;
                                                        }
                                                    }
                                                @endphp
                                                @if ($companyId)
                                                    <a class="btn btn-primary px-4 " href="">
                                                        Tham gia
                                                    </a>
                                                @endif
                                                <a id="detailWorkshop" style="margin-left: 10px"
                                                    class="btn btn-secondary px-4" data-toggle="modal"
                                                    data-target="#detailsModal" data-slug="{{ $workshop->slug }}">
                                                    Xem chi tiết
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <p class="text-center"> Chưa có Work Shop nào</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" style=" width: 60%; max-width: none;"> <!-- Đặt chiều rộng tối đa là 80% -->
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="detailsModalLabel">Chi tiết WorkShop</h2>
                    <button id="closeModalButton" type="button" class="btn-close" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="workShopForm" method="POST">
                        <div class="row">
                            <div>

                                <div class="card p-4">
                                    <div class="mb-4">

                                        <h3 id="name"></h3>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="ul-li">
                                                <ul class="d-flex mb-2">
                                                    <li class="me-3 me-lg-5 d-flex align-items-center"><svg class="me-2 "
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12 14C12.1978 14 12.3911 13.9414 12.5556 13.8315C12.72 13.7216 12.8482 13.5654 12.9239 13.3827C12.9996 13.2 13.0194 12.9989 12.9808 12.8049C12.9422 12.6109 12.847 12.4327 12.7071 12.2929C12.5673 12.153 12.3891 12.0578 12.1951 12.0192C12.0011 11.9806 11.8 12.0004 11.6173 12.0761C11.4346 12.1518 11.2784 12.28 11.1685 12.4444C11.0587 12.6089 11 12.8022 11 13C11 13.2652 11.1054 13.5196 11.2929 13.7071C11.4804 13.8946 11.7348 14 12 14ZM17 14C17.1978 14 17.3911 13.9414 17.5556 13.8315C17.72 13.7216 17.8482 13.5654 17.9239 13.3827C17.9996 13.2 18.0194 12.9989 17.9808 12.8049C17.9422 12.6109 17.847 12.4327 17.7071 12.2929C17.5673 12.153 17.3891 12.0578 17.1951 12.0192C17.0011 11.9806 16.8 12.0004 16.6173 12.0761C16.4346 12.1518 16.2784 12.28 16.1685 12.4444C16.0587 12.6089 16 12.8022 16 13C16 13.2652 16.1054 13.5196 16.2929 13.7071C16.4804 13.8946 16.7348 14 17 14ZM12 18C12.1978 18 12.3911 17.9414 12.5556 17.8315C12.72 17.7216 12.8482 17.5654 12.9239 17.3827C12.9996 17.2 13.0194 16.9989 12.9808 16.8049C12.9422 16.6109 12.847 16.4327 12.7071 16.2929C12.5673 16.153 12.3891 16.0578 12.1951 16.0192C12.0011 15.9806 11.8 16.0004 11.6173 16.0761C11.4346 16.1518 11.2784 16.28 11.1685 16.4444C11.0587 16.6089 11 16.8022 11 17C11 17.2652 11.1054 17.5196 11.2929 17.7071C11.4804 17.8946 11.7348 18 12 18ZM17 18C17.1978 18 17.3911 17.9414 17.5556 17.8315C17.72 17.7216 17.8482 17.5654 17.9239 17.3827C17.9996 17.2 18.0194 16.9989 17.9808 16.8049C17.9422 16.6109 17.847 16.4327 17.7071 16.2929C17.5673 16.153 17.3891 16.0578 17.1951 16.0192C17.0011 15.9806 16.8 16.0004 16.6173 16.0761C16.4346 16.1518 16.2784 16.28 16.1685 16.4444C16.0587 16.6089 16 16.8022 16 17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18ZM7 14C7.19778 14 7.39112 13.9414 7.55557 13.8315C7.72002 13.7216 7.84819 13.5654 7.92388 13.3827C7.99957 13.2 8.01937 12.9989 7.98079 12.8049C7.9422 12.6109 7.84696 12.4327 7.70711 12.2929C7.56725 12.153 7.38907 12.0578 7.19509 12.0192C7.00111 11.9806 6.80004 12.0004 6.61732 12.0761C6.43459 12.1518 6.27841 12.28 6.16853 12.4444C6.05865 12.6089 6 12.8022 6 13C6 13.2652 6.10536 13.5196 6.29289 13.7071C6.48043 13.8946 6.73478 14 7 14ZM19 4H18V3C18 2.73478 17.8946 2.48043 17.7071 2.29289C17.5196 2.10536 17.2652 2 17 2C16.7348 2 16.4804 2.10536 16.2929 2.29289C16.1054 2.48043 16 2.73478 16 3V4H8V3C8 2.73478 7.89464 2.48043 7.70711 2.29289C7.51957 2.10536 7.26522 2 7 2C6.73478 2 6.48043 2.10536 6.29289 2.29289C6.10536 2.48043 6 2.73478 6 3V4H5C4.20435 4 3.44129 4.31607 2.87868 4.87868C2.31607 5.44129 2 6.20435 2 7V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7957 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7957 22 19V7C22 6.20435 21.6839 5.44129 21.1213 4.87868C20.5587 4.31607 19.7957 4 19 4ZM20 19C20 19.2652 19.8946 19.5196 19.7071 19.7071C19.5196 19.8946 19.2652 20 19 20H5C4.73478 20 4.48043 19.8946 4.29289 19.7071C4.10536 19.5196 4 19.2652 4 19V10H20V19ZM20 8H4V7C4 6.73478 4.10536 6.48043 4.29289 6.29289C4.48043 6.10536 4.73478 6 5 6H19C19.2652 6 19.5196 6.10536 19.7071 6.29289C19.8946 6.48043 20 6.73478 20 7V8ZM7 18C7.19778 18 7.39112 17.9414 7.55557 17.8315C7.72002 17.7216 7.84819 17.5654 7.92388 17.3827C7.99957 17.2 8.01937 16.9989 7.98079 16.8049C7.9422 16.6109 7.84696 16.4327 7.70711 16.2929C7.56725 16.153 7.38907 16.0578 7.19509 16.0192C7.00111 15.9806 6.80004 16.0004 6.61732 16.0761C6.43459 16.1518 6.27841 16.28 6.16853 16.4444C6.05865 16.6089 6 16.8022 6 17C6 17.2652 6.10536 17.5196 6.29289 17.7071C6.48043 17.8946 6.73478 18 7 18Z"
                                                                fill="#FFD125" />
                                                        </svg>
                                                        Bắt đầu: <h4 style="margin-left: 10px" id="start_date"></h4>

                                                    <li class="me-3 me-lg-5 d-flex align-items-center"><svg class="me-2"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12 6C11.8687 5.99997 11.7386 6.02581 11.6173 6.07605C11.4959 6.12629 11.3857 6.19995 11.2928 6.29282C11.2 6.38568 11.1263 6.49594 11.0761 6.61728C11.0258 6.73862 11 6.86867 11 7V11.3838L8.56934 12.6069C8.45206 12.6659 8.34755 12.7474 8.26178 12.8468C8.176 12.9462 8.11064 13.0615 8.06942 13.1861C8.0282 13.3108 8.01194 13.4423 8.02156 13.5733C8.03118 13.7042 8.0665 13.8319 8.12549 13.9492C8.18448 14.0665 8.26599 14.171 8.36538 14.2568C8.46476 14.3426 8.58006 14.4079 8.70471 14.4491C8.82935 14.4904 8.96089 14.5066 9.09182 14.497C9.22274 14.4874 9.35049 14.4521 9.46777 14.3931L12.4492 12.8931C12.6148 12.81 12.7541 12.6824 12.8513 12.5247C12.9486 12.367 13.0001 12.1853 13 12V7C13 6.86867 12.9742 6.73862 12.924 6.61728C12.8737 6.49594 12.8001 6.38568 12.7072 6.29282C12.6143 6.19995 12.5041 6.12629 12.3827 6.07605C12.2614 6.02581 12.1313 5.99997 12 6ZM12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C21.997 9.34877 20.9424 6.80699 19.0677 4.93228C17.193 3.05758 14.6512 2.00303 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23985 18.6518 7.55544C19.5308 8.87103 20 10.4178 20 12C19.9976 14.121 19.1539 16.1544 17.6542 17.6542C16.1544 19.1539 14.121 19.9976 12 20Z"
                                                                fill="#01A3FF" />
                                                        </svg>
                                                        Kết thúc: <h4 style="margin-left: 10px" id="end_date"></h4>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4 d-flex">
                                        <h4 class="form-label">Số lượng:</h4>
                                        <h4 id="amount"></h4>
                                    </div>
                                    <div class="mb-4">
                                        <h4 class="form-label">Mô tả:</h4>
                                        <div class="content">
                                            <p class="detailWorkshop"></p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Yêu cầu hợp tác</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="university_id" value="{{ $detail->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="col-form-label required">Tiêu đề:</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label required">Nội dung:</label>
                            <textarea name="content" class="form-control tinymce_editor_init" id="content"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                        <button type="submit" data-url="{{ route('collaborationStore') }}"
                                id="collaborationRequestForm" class="btn btn-primary">Gửi yêu cầu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#collaborationRequestForm').click(function(e) {
            e.preventDefault();

            // Disable the submit button to prevent multiple submissions
            $(this).prop('disabled', true);

            let title = $('input[name="title"]').val().trim();
            let contentData = CKEDITOR.instances['content'].getData().trim(); // CKEditor content

            if (!title) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Tiêu đề là bắt buộc.",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu không có tiêu đề
            }

            if (!contentData) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Nội dung là bắt buộc.",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu không có nội dung
            }

            // Gửi yêu cầu AJAX nếu các trường đã hợp lệ
            let url = $(this).data('url');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    title: title,
                    content: contentData,
                    university_id: $('input[name="university_id"]').val()
                },
                success: function(response) {
                    // Thành công
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Yêu cầu hợp tác đã được thêm thành công!"
                    });

                    // Đóng modal và reload trang sau khi thông báo
                    $('#exampleModal').modal('hide');
                    setTimeout(function() {
                        location.reload(); // Reload lại trang
                    }, 2000); // Chờ thông báo hoàn tất
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors; // Lấy danh sách lỗi từ response

                    // Xóa thông báo lỗi cũ
                    $('span.error_collab').html('');

                    // Kiểm tra và hiển thị lỗi cụ thể
                    if (errors.title) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Lỗi tiêu đề: " + errors.title[0],
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }
                    if (errors.content) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Lỗi nội dung: " + errors.content[0],
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }

                    // Re-enable the submit button in case of error
                    $('#collaborationRequestForm').prop('disabled', false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#detailWorkshop', function(e) {
                var slug = $(this).data('slug');
                console.log(slug);
                var url = '{{ route('detailWorkShop', ':slug') }}'.replace(':slug', slug);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        $('#detailsModal #workShopForm #name').text(response.name);
                        $('#avatar_path').attr('src', response.avatar_path);
                        $('#detailsModal #workShopForm #start_date').text(response
                            .start_date);
                        $('#detailsModal #workShopForm #end_date').text(response
                            .end_date);
                        $('#detailsModal #workShopForm #amount').text(response
                            .amount + ' người');
                        $('#detailsModal .content .detailWorkshop').html(response.content);

                    },
                    error: function(xhr, status, error) {
                        console.log('Lỗi: ', error);
                    }
                });

            });
        });
    </script>

@endsection
