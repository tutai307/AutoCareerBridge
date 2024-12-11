@extends('client.layout.main')
@section('title', 'Detail Company')
@section('content')
    {{--    breacrumb--}}
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
                    <div class="jp_listing_left_sidebar_wrapper">
                    @if($company->description)
                            <div class="jp_job_des">
                                <h2>Mô tả</h2>
                                <p>{!! $company->description !!}</p>
                            </div>
                    @endif
                        <div class="jp_job_des">
                            <h2>Giới thiệu</h2>
                            <p>{!! $company->about !!}</p>
                        </div>
                        <div class="jp_job_map">
                            <h2>Bản đồ</h2>
                            <div id="map" style="width:100%; float:left; height:300px;">
                                @if(!empty($company->address))
                                    <iframe
                                        width="100%"
                                        height="300"
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        style="border:0"
                                        src="https://www.google.com/maps?q={{$company->address}}&output=embed"
                                        allowfullscreen>
                                    </iframe>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="jp_listing_left_bottom_sidebar_key_wrapper">
                        <ul>
                            <li><i class="fa fa-tags"></i>Các lĩnh vực :</li>
                            @if($company->fields)
                                @foreach($company->fields as $field)
                                    <li><a href="#"> {{ $field->name}}</a></li>

                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <div class="jp_listing_related_heading_wrapper">
                        <h2>Công việc đang hoạt động</h2>
                        <div class="jp_listing_related_slider_wrapper">
                            @foreach($company->jobs as $job)
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div
                                                class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                <div class="jp_job_post_main_wrapper">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                            <div class="jp_job_post_side_img" >
                                                                <img data-toggle="tooltip" title="{{ $job->company->name }}" src="{{ asset($job->company->avatar_path) }}"

                                                                     alt="post_img"/>
                                                            </div>
                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">
                                                                <h4  data-toggle="tooltip" title="{{ ucwords($job->name)}}">{{ ucwords($job->name) }}</h4>
                                                                <span  data-toggle="tooltip" title="{{  strtoupper($job->company->name)  }}">{{  strtoupper($job->company->name)  }}</span>
                                                            </div>
                                                            <div class="jp_job_post_right_content d-flex align-items-center justify-content-between">
                                                                <ul>
                                                                    <li data-toggle="tooltip" title="{{ ucwords($company->province) }}, {{ ucwords($company->district) }}">
                                                                        <i class="fa-solid fa-location-dot" style="color: #ff5353;"></i> {{ ucwords($company->province) }}
                                                                    </li>
                                                                </ul>
                                                                <p class="mt-1">
                                                                    Còn <strong>{{ $job->job_time}}</strong> ngày để ứng tuyển
                                                                </p>
                                                            </div>


                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="jp_job_post_right_btn_wrapper">
                                                                <ul>
                                                                    <li><a href="#">Ứng tuyển</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="jp_job_post_keyword_wrapper">
                                                    <ul>
                                                        <li><i class="fa fa-tags"></i>Chuyên ngành :</li>
                                                        @if($job->major)
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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 position_class">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Thông tin doanh nghiệp</h4>
                                </div>
                                <div class="jp_jop_overview_img_wrapper">
                                    <div class="jp_jop_overview_img">
                                        <img
                                            src="{{ $company->avatar_path ? asset($company->avatar_path) : asset('clients/images/content/web.png')}}"
                                            alt="post_img"/>
                                    </div>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont ">
                                    <div class="jp_job_listing_single_post_right_cont_wrapper ">
                                        <h4>{{ $company->name }}</h4>
                                        <div style="display: flex; justify-content:space-evenly;margin: 20px 0%">
                                            <div>
                                                <h3 class="m-b-0">{{$company->size}}</h3>
                                                <p>Quy mô</p>
                                            </div>
                                            <div class="mx-1">
                                                <h3 class="m-b-0">
                                                    {{ $company->fields->count()}}
                                                </h3>
                                                <p>Lĩnh vực</p>
                                            </div>
                                            <div>
                                                <h3 class="m-b-0">{{$company->collaborations->count()}}</h3>
                                                <p>Liên kểt</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jp_job_post_right_overview_btn_wrapper">
                                    <div class="jp_job_post_right_overview_btn">
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
                                                        ->where('status', STATUS_APPROVED )
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
                                                <a class="btn btn-sm px-4 btn-danger" href="#">
                                                    Hủy yêu cầu
                                                </a>
                                            @elseif ($isFollowed)
                                                <a class="btn btn-sm px-4 btn-secondary" href="#">
                                                    Đang hợp tác
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#exampleModal">Yêu cầu hợp tác
                                                </button>
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
                                            <i class="fa fa-star"></i>
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
@endsection
