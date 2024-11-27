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
                                    <li><a href="{{ route('home') }}">Trang chủ</a> <i class="fa fa-angle-right"></i></li>
                                    <li><a href="{{ route('listUniversity') }}">Trường học</a> <i class="fa fa-angle-right"></i></li>
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
        <div class="container" >
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
                    <div class="jp_rightside_job_categories_heading">
                        <h4>Tổng quan trường học</h4>
                    </div>
                    <div class="jp_listing_left_sidebar_wrapper">    
                       
                        <div class="jp_job_des">
                            <h2>Giới thiệu</h2>
                            {!! $detail->description !!}
                        </div>
                        <div class="jp_job_res">
                            <h2>Mô tả</h2>
                            {!! $detail->about !!}
                        </div>
                        <div class="jp_job_res jp_job_qua">
                            <h2>Các ngành học</h2>
                            <ul>
                                @foreach($majors as $major)
                                <a href="" class="btn btn-primary light btn-xs mb-1" >
                                    {{ $major->name }}
                                </a>
                                @endforeach
                            </ul>
                        </div>
                        <div class="jp_job_res jp_job_qua">
                            <h2>Thông tin trường học</h2>
                            <ul>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Tên trường <span class="pull-end">:</span>
                                        </h5>
                                    </div>
                                    <div class="col-sm-9 col-7"><span>{{$detail->name}}</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-3 col-5">
                                        <h5 class="f-w-500">Email <span class="pull-end">:</span>
                                        </h5>
                                    </div>
                                    <div class="col-sm-9 col-7"><span>{{$detail->user->email}}</span>
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
                                    <div class="col-sm-9 col-7"><span>{{$detail->students->count()}} sinh viên</span>
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
                    
                    
                     <div class="jp_listing_related_heading_wrapper">
                        <h2>Work Shops</h2>
                        <div class="jp_listing_related_slider_wrapper">
                            <div class="owl-carousel owl-theme">

                                    
                                @forelse($workshops as $workshop)
                                    <div class="card mb-3" style="width: 100%; border: 1px solid #e8e8e7; border-radius: 8px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img style="height: 100% ;object-fit: cover;width: 100%;" src="{{$workshop->avatar_path}}" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body" style="padding-bottom:10px;">
                                                    <h3 style="" class="card-title">{{$workshop->name}}</h3>
                                                    <p class="card-text">{!! Str::limit($workshop->content, 100, '...') !!}</p></p>
                                                    <p class="card-text"><small class="text-muted">Thời gian bắt đầu: <b>{{$workshop->start_date}}</b></small></p>
                                                    <p class="card-text"><small class="text-muted">Thời gian kết thúc: <b>{{$workshop->end_date}}</b></small></p>
                                                    <div class="d-flex justify-content-end mb-0"> 
                                                            @php
                                                            $companyId = null;
                                                            if (auth()->guard('admin')->check()) {
                                                                        $user = auth()->guard('admin')->user();
                                                                        if ($user && $user->company) {
                                                                            $companyId = $user->company->id;
                                                                        }
                                                                    }
                                                         @endphp
                                                         @if($companyId)
                                                        <a class="btn btn-primary px-4 " 
                                                        href="">
                                                         Tham gia
                                                     </a>
                                                     @endif
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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Thông tin liên hệ</h4>
                                </div>
                                <div class="jp_jop_overview_img_wrapper">
                                    <div class="jp_jop_overview_img">
                                        <img style="width: 100px; height: 100px; object-fit: cover; object-position: center;"
                                        src="{{ isset($detail->avatar_path) ? asset('storage/' . $detail->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                        alt="hiring_img" />
                                    </div>
                                </div>
                                <div class="jp_job_listing_single_post_right_cont">
                                    <div class="jp_job_listing_single_post_right_cont_wrapper">
                                        <h4>{{$detail->name}}</h4>
                                    </div>
                                    <div style="margin-top: 50px; margin-bottom: 20px" class="row">
                                        <div class="col">
                                            <h3 class="m-b-0">{{$detail->students->count()}}</h3><p >Quy mô</p>
                                        </div>
                                        <div class="col">
                                            <h3 class="m-b-0">{{count($majors)}}</h3><p>Ngành</p>
                                        </div>
                                        <div class="col">
                                            <h3 class="m-b-0">{{$detail->collaborations->count()}}</h3><p>Liên kểt</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="jp_job_post_right_overview_btn_wrapper">
                                    @php
                                    $companyId = null;
                                    $isFollowed = false;
                                    $isPending = false;
                                    if (auth()->guard('admin')->check()) {
                                        $user = auth()->guard('admin')->user();
                                        if ($user && $user->company) {
                                            $companyId = $user->company->id;
                                            $isFollowed = $detail->collaborations()
                                                                 ->where('status', 2)
                                                                 ->where('company_id', $companyId)
                                                                 ->exists();
                                            $isPending = $detail->collaborations()
                                                                ->where('status', 1)
                                                                ->where('company_id', $companyId)
                                                                ->exists();
                                        }
                                    }
                                @endphp
                                @if ($companyId)
                                    @if ($isPending)
                                        <a class="btn btn-sm px-4 btn-secondary" href="#">
                                            Hủy yêu cầu
                                        </a>
                                    @elseif ($isFollowed)
                                        <a class="btn btn-sm px-4 btn-secondary" href="#">
                                            Đang hợp tác
                                        </a>
                                    @else
                                        <a class="btn btn-sm px-4 btn-primary" href="#">
                                            Hợp tác
                                        </a>
                                    @endif
                                @endif
                                </div>
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="profile-blog">
                                                <h5 class="text-primary d-inline">
                                                    <div class="jp_listing_list_icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                                    Địa chỉ </h5>
                                                <p>{{$full_address}}</p>
                                                <h5 class="text-primary d-inline">
                                                    Xem bản đồ</h5>
                                                <?php
                    
                                                $encodedAddress = urlencode($full_address);
                                                ?>
                    
                                                <div style="width: 100%; height: 400px;">
                                                    <iframe
                                                        src="https://www.google.com/maps?q=<?php echo $encodedAddress; ?>&output=embed"
                                                        width="100%"
                                                        height="100%"
                                                        style="border:0;"
                                                        allowfullscreen=""
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
        </div>
    </div>
@endsection
