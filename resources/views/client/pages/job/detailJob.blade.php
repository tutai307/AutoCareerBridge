@extends('client.layout.main')
@section('title', 'Chi tiết công việc ')

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
    <!-- jp Tittle Wrapper Start -->
    <!-- jp Tittle Wrapper End -->
    <!-- jp listing Single cont Wrapper Start -->
    <div class="jp_listing_single_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="jp_rightside_job_categories_heading">
                        <h4>Mô tả công việc</h4>
                    </div>
                    <div class="jp_listing_left_sidebar_wrapper">
                        <div class="jp_job_des">
                            <h2>Giới thiệu</h2>
                            <p>{!! $job->company->description !!}</p>
                        </div>
                        <div class="jp_job_res">
                            <h2>Mô tả</h2>
                            <p>{!! $job->detail ?? 'Underfined' !!}</p>
                        </div>

                        <div class="jp_job_apply">
                            <h2>Ứng tuyển</h2>
                            <p>Vui lòng gửi CV về theo website công ty: {{ $job->company->website_link }}.</p>
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
        </div>
    </div>
@endsection
