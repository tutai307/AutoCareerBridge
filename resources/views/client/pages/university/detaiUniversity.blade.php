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
                        <div class="jp_job_res">
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
                                                            ->where('status', STATUS_APPROVED)
                                                            ->where('company_id', $companyId)
                                                            ->exists();
                                                        $isPending = $detail
                                                            ->collaborations()
                                                            ->where('status', STATUS_PENDING)
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
                                                    <i class="fa-solid fa-location-dot me-2" style="color: #ff5353;"></i>
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
                                                <iframe src="https://www.google.com/maps?q=<?php echo $encodedAddress; ?>&output=embed"
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

            <div class="jp_listing_related_heading_wrapper">
                <h2>Work Shops</h2>
                <div class="jp_listing_related_slider_wrapper">
                    <div class="owl-carousel owl-theme">
                        @forelse($workshops as $workshop)
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                            <div class="jp_job_post_main_wrapper">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <a href="{{ route('detailWorkShop', $workshop->slug) }}">
                                                            <div class="jp_job_post_side_img">
                                                                <img style="width: 100%; height: 100px; object-fit: cover; object-position: center;"
                                                                    src="{{ $workshop->avatar_path }}"
                                                                    alt="{{ $workshop->name }}" />
                                                            </div>

                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">
                                                                <h4 title="{{ $workshop->name }}">
                                                                    {{ \Str::limit($workshop->name, 100) }}
                                                                </h4>
                                                                <p><b>Số lượng:</b> {{ $workshop->amount }} người</p>
                                                            </div>
                                                            <div
                                                                class="jp_job_post_right_content d-flex align-items-center justify-content-between">
                                                                <p class="mt-1">
                                                                    <i class="fa-solid fa-calendar"
                                                                        style="color: #ff5353;"></i>
                                                                    Bắt đầu: {{ $workshop->start_date }}
                                                                </p>
                                                                <p class="mt-1">
                                                                    <i class="fa-solid fa-calendar"
                                                                        style="color: #ff5353;"></i>
                                                                    Kết thúc: <strong>{{ $workshop->end_date }}</strong>
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <div class="jp_job_post_right_btn_wrapper">
                                                            <ul>
                                                                <li>
                                                                    <a width="140px"
                                                                        href="{{ route('detailWorkShop', $workshop->slug) }}">Xem
                                                                        chi tiết</a>
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
                        @empty
                            <p class="text-center"> Chưa có Work Shop nào</p>
                        @endforelse
                    </div>

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

            if (!end_date) {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "error",
                    title: "Ngày kết thúc là bắt buộc.",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu không có nội dung
            }
            if (end_date) {
                // Chuyển đổi end_date thành đối tượng Date
                let endDateObj = new Date(end_date);

                // Lấy ngày hiện tại
                let today = new Date();

                // Tạo ngày mới cách hôm nay 3 tháng
                today.setMonth(today.getMonth() + 3);

                // Kiểm tra xem end_date có ít nhất 3 tháng so với ngày hôm nay không
                if (endDateObj < today) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "error",
                        title: "Ngày kết thúc phải cách hôm nay 3 tháng.",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    // Re-enable the submit button if validation fails
                    $(this).prop('disabled', false);
                    return;
                }
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
                    university_id: $('input[name="university_id"]').val(),
                    end_date: $('input[name="end_date"]').val()
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
                    if (errors.end_date) {
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            icon: "error",
                            title: "Lỗi ngày: " + errors.content[0],
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
@endsection
