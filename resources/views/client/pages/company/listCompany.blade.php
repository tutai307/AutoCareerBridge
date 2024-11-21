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
                            <h2>{{ __('label.client.title.companies') }}</h2>
                        </div>
                        <div class="jp_tittle_breadcrumb_main_wrapper">
                            <div class="jp_tittle_breadcrumb_wrapper">
                                <ul>
                                    <li><a href="{{ route('home') }}">{{ __('label.breadcrumb.home') }}</a> <i class="fa fa-angle-right"></i></li>
                                    <li>{{ __('label.breadcrumb.company') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jp_listing_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_listing_heading_wrapper">
                        <h2>We found <span>357</span> Matches for you.</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_job_location_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Jobs by Location</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                <p>
                                                    <input type="checkbox" id="c9" name="cb">
                                                    <label for="c9">Jobs in Delhi <span>(214)</span></label>

                                                <p>
                                                    <input type="checkbox" id="c10" name="cb">
                                                    <label for="c10">Jobs in Mumbai <span>(514)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c11" name="cb">
                                                    <label for="c11">Jobs in Chennai <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c12" name="cb">
                                                    <label for="c12">Jobs in Gurgaon <span>(457)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c13" name="cb">
                                                    <label for="c13">Jobs in Noida <span>(1254)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c14" name="cb">
                                                    <label for="c14">Jobs in Kolkata <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c15" name="cb">
                                                    <label for="c15">Jobs in Hyderabad <span>(350)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c16" name="cb">
                                                    <label for="c16">Jobs in Pune <span>(221)</span></label>
                                                </p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a href="#">SHOW MORE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_job_location_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Your Skill’s</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                <p>
                                                    <input type="checkbox" id="c17" name="cb">
                                                    <label for="c17">Javascript <span>(214)</span></label>

                                                <p>
                                                    <input type="checkbox" id="c18" name="cb">
                                                    <label for="c18">HTML5 <span>(514)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c19" name="cb">
                                                    <label for="c19">CSS3 <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c20" name="cb">
                                                    <label for="c20">PHP <span>(457)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c21" name="cb">
                                                    <label for="c21">Sales <span>(1254)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c22" name="cb">
                                                    <label for="c22">Marketing <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c23" name="cb">
                                                    <label for="c23">Social Media <span>(350)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c24" name="cb">
                                                    <label for="c24">Web Design <span>(221)</span></label>
                                                </p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a href="#">SHOW MORE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_rightside_job_categories_wrapper jp_job_location_wrapper">
                                <div class="jp_rightside_job_categories_heading">
                                    <h4>Types</h4>
                                </div>
                                <div class="jp_rightside_job_categories_content">
                                    <div class="handyman_sec1_wrapper">
                                        <div class="content">
                                            <div class="box">
                                                <p>
                                                    <input type="checkbox" id="c33" name="cb">
                                                    <label for="c33">Types <span>(214)</span></label>

                                                <p>
                                                    <input type="checkbox" id="c34" name="cb">
                                                    <label for="c34">Part-time <span>(514)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c35" name="cb">
                                                    <label for="c35">Contract <span>(554)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c36" name="cb">
                                                    <label for="c36">Remotely <span>(457)</span></label>
                                                </p>
                                                <p>
                                                    <input type="checkbox" id="c37" name="cb">
                                                    <label for="c37">Temporary <span>(1254)</span></label>
                                                </p>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><i class="fa fa-plus-circle"></i> <a href="#">SHOW MORE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
                        {{--                            <div class="jp_add_resume_wrapper jp_job_location_wrapper">--}}
                        {{--                                <div class="jp_add_resume_img_overlay"></div>--}}
                        {{--                                <div class="jp_add_resume_cont">--}}
                        {{--                                    <img src="{{ asset('clients/images/content/resume_logo.png')}}" alt="logo"/>--}}
                        {{--                                    <h4>Get Best Matched Jobs On your Email. Add Resume NOW!</h4>--}}
                        {{--                                    <ul>--}}
                        {{--                                        <li><a href="#"><i class="fa fa-plus-circle"></i> &nbsp;ADD RESUME</a></li>--}}
                        {{--                                    </ul>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_listing_tabs_wrapper">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="gc_causes_select_box_wrapper">
                                        <div class="gc_causes_select_box">
                                            <select>
                                                <option>Sort Default</option>
                                                <option>Sort Default</option>
                                                <option>Sort Default</option>
                                            </select><i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="gc_causes_view_tabs_wrapper">
                                        <div class="gc_causes_view_tabs">
                                            <ul class="nav nav-pills">
                                                <li class="active"><a data-toggle="pill" href="#grid"><i
                                                            class="fa fa-th-large"></i></a></li>
                                                <li><a data-toggle="pill" href="#list"><i class="fa fa-list"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    <div class="gc_causes_search_box_wrapper gc_causes_search_box_wrapper2">
                                        <div class="gc_causes_search_box">
                                            <p>You're Watching &nbsp;<span>01 to 20</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="tab-content">
                                <div id="grid" class="tab-pane fade in active">
                                    <div class="row">
                                        @foreach($listCompanies as $company)
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                    <div
                                                        class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                        <div
                                                            class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="jp_job_post_side_img">
                                                                        <img
                                                                            src="{{isset($company->avatar_path) ? asset('storage/'.$company->avatar_path) : ""}}"
                                                                            style="object-fit: cover; width: 100%; height: 100%; object-position: center;"
                                                                            alt="image"/>
                                                                    </div>
                                                                    <div
                                                                        class="jp_job_post_right_cont jp_job_post_grid_right_cont jp_cl_job_cont">
                                                                        <h4>{{$company->name}}</h4>
                                                                        <p>MARKETING JOB</p>
                                                                        <ul>
                                                                            @foreach($company->addresses as $address)
                                                                                <li><i class="fa fa-map-marker"></i>&nbsp;
                                                                                    <span>{{ $address->specific_address }},
                                                                                    {{ $address->ward ? $address->ward->name . ', ' : '' }}
                                                                                        {{ $address->district ? $address->district->name . ', ' : '' }}
                                                                                        {{ $address->province ? $address->province->name : '' }}</span>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                        <div
                                                                            class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper jp_cl_aply_btn">
                                                                            <ul>
                                                                                <li><a href="#">145 ACTIVE JOBS</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jp_job_post_keyword_wrapper">
                                                            <ul>
                                                                <li><i class="fa fa-tags"></i>Keywords :</li>
                                                                <li><a href="#">ui designer,</a></li>
                                                                <li><a href="#">developer,</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                            <div class="pager_wrapper gc_blog_pagination">
                                                <ul class="pagination">
                                                    {{--                                                        <!-- Hiển thị "Previous" -->--}}
                                                    {{--                                                        <li class="{{ $company->onFirstPage() ? 'disabled' : '' }}">--}}
                                                    {{--                                                            <a href="{{ $company->previousPageUrl() }}">Prev.</a>--}}
                                                    {{--                                                        </li>--}}

                                                    {{--                                                        <!-- Hiển thị các trang -->--}}
                                                    {{--                                                        @foreach ($company->getUrlRange(1, $company->lastPage()) as $page => $url)--}}
                                                    {{--                                                            <li class="{{ $page == $company->currentPage() ? 'active' : '' }}">--}}
                                                    {{--                                                                <a href="{{ $url }}">{{ $page }}</a>--}}
                                                    {{--                                                            </li>--}}
                                                    {{--                                                        @endforeach--}}

                                                    {{--                                                        <!-- Hiển thị "Next" -->--}}
                                                    {{--                                                        <li class="{{ $company->hasMorePages() ? '' : 'disabled' }}">--}}
                                                    {{--                                                            <a href="{{ $company->nextPageUrl() }}">Next</a>--}}
                                                    {{--                                                        </li>--}}
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="list" class="tab-pane fade">
                                    <div class="row">
                                        @foreach($listCompanies as $company)
                                            <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div
                                                        class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                        <div class="jp_job_post_main_wrapper">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                    <div class="jp_job_post_side_img">
                                                                        <img
                                                                            src="{{isset($company->avatar_path) ? asset('storage/'.$company->avatar_path) : ""}}"
                                                                            style="object-fit: cover; width: 100%; height: 100%; object-position: center;"
                                                                            alt="image"/>
                                                                    </div>
                                                                    <div class="jp_job_post_right_cont jp_cl_job_cont">
                                                                        <h4>COMERA JOB PORT</h4>
                                                                        <p>MARKETING JOB</p>
                                                                        <ul>
                                                                            @if($company->addresses)
                                                                                @foreach($company->addresses as $address)
                                                                                    <li><i class="fa fa-map-marker"></i>&nbsp;
                                                                                        <span>{{ $address->specific_address }},
                                                                                    {{ $address->ward ? $address->ward->name . ', ' : '' }}
                                                                                            {{ $address->district ? $address->district->name . ', ' : '' }}
                                                                                            {{ $address->province ? $address->province->name : '' }}</span>
                                                                                    </li>
                                                                                @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="jp_job_post_right_btn_wrapper">
                                                                        <ul>
                                                                            <li><a href="#">145 ACTIVE JOBS</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="jp_job_post_keyword_wrapper">
                                                            <ul>
                                                                <li><i class="fa fa-tags"></i>Keywords :</li>
                                                                <li><a href="#">ui designer,</a></li>
                                                                <li><a href="#">developer,</a></li>
                                                                <li><a href="#">senior</a></li>
                                                                <li><a href="#">it company,</a></li>
                                                                <li><a href="#">design,</a></li>
                                                                <li><a href="#">call center</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                            <div class="pager_wrapper gc_blog_pagination">
                                                <ul class="pagination">
                                                    <li><a href="#">Priv.</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li class="hidden-xs"><a href="#">4</a></li>
                                                    <li><a href="#">Next</a></li>
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
    </div>
@endsection
@session('css')

@endsession
@section('js')

@endsection
