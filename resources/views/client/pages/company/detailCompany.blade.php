@extends('client.layout.main')
@section('title', 'List Company')
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
                                    <li><a href="{{ route('home') }}">{{ __('label.breadcrumb.home') }}</a> <i class="fa fa-angle-right"></i></li>
                                    <li><a href="{{ route('listCompany') }}">{{ __('label.breadcrumb.company') }}</a> <i class="fa fa-angle-right"></i></li>
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
                        <div class="jp_job_des">
                            <h2>Mô tả</h2>
                            <p>{!! $company->description !!}</p>
                        </div>
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


{{--                    <div class="jp_listing_related_heading_wrapper">--}}
{{--                        <h2>Related Jobs</h2>--}}
{{--                        <div class="jp_listing_related_slider_wrapper">--}}
{{--                            <div class="owl-carousel owl-theme">--}}
{{--                                <div class="item">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img1.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img2.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img3.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img1.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img2.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img3.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="item">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img1.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img2.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
{{--                                            <div class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">--}}
{{--                                                <div class="jp_job_post_main_wrapper">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_side_img">--}}
{{--                                                                <img src="{{ asset('clients/images/content/job_post_img3.jpg')}}" alt="post_img" />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="jp_job_post_right_cont jp_cl_job_cont">--}}
{{--                                                                <h4>COMERA JOB PORT</h4>--}}
{{--                                                                <p>MARKETING JOB</p>--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><i class="fa fa-map-marker"></i>&nbsp; Caliphonia, PO 455001</li>--}}
{{--                                                                </ul>--}}
{{--                                                                <h5>145 ACTIVE JOBS</h5>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">--}}
{{--                                                            <div class="jp_job_post_right_btn_wrapper">--}}
{{--                                                                <ul>--}}
{{--                                                                    <li><a href="#">Follow</a></li>--}}
{{--                                                                </ul>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="jp_job_post_keyword_wrapper">--}}
{{--                                                    <ul>--}}
{{--                                                        <li><i class="fa fa-tags"></i>Keywords :</li>--}}
{{--                                                        <li><a href="#">ui designer,</a></li>--}}
{{--                                                        <li><a href="#">developer,</a></li>--}}
{{--                                                        <li><a href="#">senior</a></li>--}}
{{--                                                        <li><a href="#">it company,</a></li>--}}
{{--                                                        <li><a href="#">design,</a></li>--}}
{{--                                                        <li><a href="#">call center</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                            <div class="jp_rightside_job_categories_wrapper jp_rightside_listing_single_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Thông tin doanh nghiệp</h4>
                                </div>
                                <div class="jp_jop_overview_img_wrapper">
                                    <div class="jp_jop_overview_img">
                                        <img src="{{ $company->avatar_path ? asset($company->avatar_path) : asset('clients/images/content/web.png')}}" alt="post_img" />
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
{{--                                            <div>--}}
{{--                                                <h3 class="m-b-0">{{}}</h3>--}}
{{--                                                <p>Ngành</p>--}}
{{--                                            </div>--}}
                                            <div>
                                                <h3 class="m-b-0">{{$company->collaborations->count()}}</h3>
                                                <p>Liên kểt</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jp_job_post_right_overview_btn_wrapper">
                                    <div class="jp_job_post_right_overview_btn">
                                        <ul>
                                            <li><a href="#">141 Jobs</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="jp_listing_overview_list_outside_main_wrapper">
                                    <div class="jp_listing_overview_list_main_wrapper">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Location:</li>
                                                <li>{{ $company->address }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-info-circle"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Job Open:</li>
                                                <li>141 Jobs</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-th-large"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Size:</li>
                                                <li>{{ $company->size }} {{ __('label.admin.profile.member') }} </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="jp_listing_overview_list_main_wrapper jp_listing_overview_list_main_wrapper2">
                                        <div class="jp_listing_list_icon">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="jp_listing_list_icon_cont_wrapper">
                                            <ul>
                                                <li>Email:</li>
                                                <li>{{ $company->user->email }}</li>
                                            </ul>
                                        </div>
                                    </div>
{{--                                    <div class="jp_listing_right_bar_btn_wrapper">--}}
{{--                                        <div class="jp_listing_right_bar_btn">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="#"><i class="fa fa-plus-circle"></i> &nbsp;Follow Facebook</a></li>--}}
{{--                                                <li><a href="#"><i class="fa fa-plus-circle"></i> &nbsp;Follow NOw!</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
