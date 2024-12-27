@extends('client.layout.main')
@section('title',$company->name ?? 'Chi tiết doanh nghiệp' )
@section('content')
    {{--    breacrumb --}}
    <div class="jp_tittle_main_wrapper">
        <div class="jp_tittle_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>{{ __('label.client.title.company_information') }}</h2>
                        </div>
                        <div class="jp_tittle_breadcrumb_main_wrapper">
                            <div class="jp_tittle_breadcrumb_wrapper">
                                <ul>
                                    <li><a href="{{ route('home') }}">{{ __('label.breadcrumb.home') }}</a> <i
                                            class="fa fa-angle-right"></i></li>
                                    <li><a href="{{ route('listCompany') }}">{{ __('label.breadcrumb.company') }}</a> <i
                                            class="fa fa-angle-right"></i></li>
                                    <li>{{ __('label.breadcrumb.company_information') }}</li>
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
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_rightside_job_categories_heading">
                        <h4>Giới thiệu về doanh nghiệp</h4>
                    </div>
                    <div class="jp_listing_left_sidebar_wrapper">
                        <div class="jp_job_des jp_job_qua">
                            <h2>Giới thiệu</h2>
                            <div>{!! $company->about !!}</div>
                        </div>
                        @if ($company->description)
                            <div class="jp_job_des jp_job_qua">
                                <h2>Mô tả</h2>
                                {!! $company->description !!}
                            </div>
                        @endif
                        <div class="jp_job_map jp_job_qua">
                            <h2>Bản đồ</h2>
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
                            <li><i class="fa fa-tags"></i>Các lĩnh vực :</li>
                            @if ($company->fields)
                                @foreach ($company->fields as $field)
                                    <li><a href="#"> {{ $field->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="jp_listing_related_heading_wrapper">
                        <h2>Công việc đang tuyển dụng</h2>
                        <div class="jp_listing_related_slider_wrapper">
                            <div class="owl-carousel owl-theme">
                                @foreach ($company->jobs as $job)
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div
                                                    class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                    <div class="jp_job_post_main_wrapper">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <a href="{{ route('detailJob', ['slug' => $job->slug]) }}">
                                                                    <div class="jp_job_post_side_img">
                                                                        <img data-bs-toggle="tooltip"
                                                                             title="{{ $job->company->name }}"
                                                                             src="{{isset($job->company->avatar_path) ? asset($job->company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                             alt="post_img"/>
                                                                    </div>

                                                                    <div class="jp_job_post_right_cont jp_cl_job_cont">
                                                                        <h4 data-bs-toggle="tooltip"
                                                                            title="{{ $job->name }}">
                                                                            {{ str()->limit($job->name, 40) }}</h4>
                                                                        <p style="color:#e69920;"
                                                                           data-bs-toggle="tooltip"
                                                                           title="{{ ucfirst($job->company->name) }}">
                                                                            {{ ucfirst($job->company->name) }}</p>
                                                                    </div>
                                                                    <div
                                                                        class="jp_job_post_right_content d-flex align-items-center justify-content-between">
                                                                        <ul>
                                                                            <li data-bs-toggle="tooltip"
                                                                                title="{{ ucwords($company->province) }}, {{ ucwords($company->district) }}">
                                                                                <i class="fa-solid fa-location-dot"
                                                                                   style="color: #ff5353;"></i>
                                                                                {{ ucwords($company->province) }}
                                                                            </li>
                                                                        </ul>
                                                                        <p class="mt-1">
                                                                            Còn <strong>{{ $job->job_time }}</strong>
                                                                            ngày để ứng tuyển
                                                                        </p>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                <div class="jp_job_post_right_btn_wrapper">
                                                                    <ul>
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('detailJob', ['slug' => $job->slug]) }}">Ứng
                                                                                tuyển</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="jp_job_post_keyword_wrapper">
                                                        <ul>
                                                            <li><i class="fa fa-tags"></i>Chuyên ngành :</li>
                                                            @if ($job->major)
                                                                <li><a href="#">{{ $job->major->name }}</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Thông tin doanh nghiệp</h4>
                                </div>
                                <div class="jp_jop_overview_img_wrapper">
                                    <div class="jp_jop_overview_img">
                                        <img
                                            src="{{ $company->avatar_path ? asset($company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                            alt="post_img"/>
                                    </div>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont">
                                    <h4>{{ $company->name }}</h4>
                                    <div style="display: flex; justify-content: space-evenly; margin: 20px 0;">
                                        @foreach ([
                                            ['label' => 'Quy mô', 'value' => $company->size],
                                            ['label' => 'Lĩnh vực', 'value' => $company->fields->count()],
                                            ['label' => 'Liên kết', 'value' => $company->collaborations->count()]
                                        ] as $stat)
                                            <div>
                                                <h3 class="m-b-0">{{ $stat['value'] }}</h3>
                                                <p>{{ $stat['label'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="jp_job_post_right_overview_btn_wrapper">
                                    <div class="jp_job_post_right_overview_btn">
                                        @if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === ROLE_UNIVERSITY)
                                            @php
                                                $universityId = null;
                                                $isFollowed = false;
                                                $isPending = false;
                                                if (auth()->guard('admin')->check()) {
                                                    $user = auth()->guard('admin')->user();
                                                    if ($user && $user->university) {
                                                        $universityId = $user->university->id;
                                                        $isFollowed = $company
                                                            ->collaborations()
                                                            ->where('status', STATUS_APPROVED)
                                                            ->where('university_id', $universityId)
                                                            ->exists();
                                                        $isPending = $company
                                                            ->collaborations()
                                                            ->where('status', STATUS_PENDING)
                                                            ->where('university_id', $universityId)
                                                            ->exists();
                                                }
                                                    }
                                            @endphp
                                            @if ($universityId)
                                                @if ($isPending)
                                                    <div class="btn btn-danger d-inline-block px-4 py-2" role="alert">
                                                        Đã gửi yêu cầu
                                                    </div>
                                                @elseif ($isFollowed)
                                                    <div class="btn btn-success d-inline-block px-4 py-2" role="alert">
                                                        Đang hợp tác
                                                    </div>
                                                @else
                                                    <button type="button" class="" data-toggle="modal"
                                                            data-target="#exampleModal">Yêu cầu hợp tác
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="jp_listing_overview_list_outside_main_wrapper">
                                    <div class="jp_listing_overview_list_main_wrapper">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa-solid fa-location-dot" style="color: #ff5353;"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Địa chỉ:</li>
                                                <li>{{ $company->address ?? '' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa-regular fa-envelope" style="color: #ff5353;"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Email:</li>
                                                <li>{{ $company->user->email ?? '' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Công việc :</li>
                                                <li>{{ $company->jobs->count() ?? 0 }} Công việc
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div
                                        class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa-solid fa-users-line" style="color: #ff5353;"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Quy mô:</li>
                                                <li>{{ $company->size ?? 0 }} {{ __('label.admin.profile.member') }} </li>
                                            </ul>
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
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Yêu cầu hợp tác</h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="col-form-label required">Tiêu đề:</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="col-form-label required">Thời gian hết hạn hợp đồng:</label>
                            <input type="date" name="end_date" class="form-control" id="end_date"
                                   min="{{ now()->addMonths(3)->format('Y-m-d') }}">
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label required">Nội dung:</label>
                            <textarea name="content" class="form-control tinymce_editor_init" id="content"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Huỷ</button>
                        <button type="submit" id="collaborationRequestForm" onclick="submitForm()"
                                class="btn btn-primary">Gửi yêu cầu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#collaborationRequestForm').click(function (e) {
            e.preventDefault();

            // Disable the submit button to prevent multiple submissions
            $(this).prop('disabled', true);

            let title = $('input[name="title"]').val().trim();
            let contentData = CKEDITOR.instances['content'].getData().trim(); // CKEditor content
            let end_date = $('input[name="end_date"]').val().trim();

            if (!title) {
                  toastr.error("", "Tiêu đề là bắt buộc")
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu không có tiêu đề
            }

            if (!contentData) {
                toastr.error("", "Nội dung là bắt buộc")
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu không có nội dung
            }

            if (!end_date) {
                  toastr.error("", "Ngày kết thúc phải cách hôm nay 3 tháng")
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu không có nội dung
            }

            // Kiểm tra end_date phải lớn hơn 3 tháng so với hiện tại
            let currentDate = new Date();
            let selectedDate = new Date(end_date);
            let threeMonthsFromNow = new Date();
            threeMonthsFromNow.setMonth(currentDate.getMonth() + 3);

            if (selectedDate < threeMonthsFromNow) {
                toastr.error("", "Thời gian hết hạn hợp đồng phải lớn hơn 3 tháng so với hiện tại");
                // Re-enable the submit button if validation fails
                $(this).prop('disabled', false);
                return; // Dừng việc gửi form nếu end_date không hợp lệ
            }

            $.ajax({
                url: '{{ route('university.collaboration.invite') }}',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    title: title,
                    end_date: end_date,
                    content: contentData,
                    company_id: $('input[name="company_id"]').val()
                },
                success: function (response) {

                    // Thành công

                    if (response.error) {
                        toastr.error("", "" + response.error);
                    } else {
                        toastr.success("", "" + response.message);
                    }

                    // Đóng modal và reload trang sau khi thông báo
                    $('#exampleModal').modal('hide');
                    setTimeout(function () {
                        location.reload(); // Reload lại trang
                    }, 2000); // Chờ thông báo hoàn tất
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors; // Lấy danh sách lỗi từ response
                    const res = xhr.responseJSON

                    // Xóa thông báo lỗi cũ
                    $('span.error_collab').html('');
                    // Kiểm tra và hiển thị lỗi cụ thể
                    if (errors?.title) {
                        toastr.error("", "" + errors.title[0]);
                    }
                    if (errors?.content) {
                        toastr.error("", "" + errors.content[0]);
                    }
                    if (res.error) {
                        toastr.error("", "" + error.message);
                    }

                    // Re-enable the submit button in case of error
                    $('#collaborationRequestForm').prop('disabled', false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '#detailWorkshop', function (e) {
                var slug = $(this).data('slug');
                console.log(slug);
                var url = '{{ route('detailWorkShop', ':slug') }}'.replace(':slug', slug);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
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
                    error: function (xhr, status, error) {
                        console.log('Lỗi: ', error);
                    }
                });

            });
        });
    </script>
@endsection
