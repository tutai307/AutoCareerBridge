@extends('client.layout.main')
@section('title', 'Danh sách doanh nghiệp')
@section('content')
    {{--    breacrumb --}}
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
                                    <li><a href="{{ route('home') }}">{{ __('label.breadcrumb.home') }}</a> <i
                                            class="fa fa-angle-right"></i></li>
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
            <div class="row mt-5">

                @if ($listCompanies)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_hiring_slider_main_wrapper">
                            <div class="jp_hiring_heading_wrapper">
                                <h2>Công ty tuyển dụng hàng đầu</h2>
                            </div>
                            <div class="jp_hiring_slider_wrapper">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($listCompanies as $company)
                                        <div class="item">
                                            <div class="jp_hiring_content_main_wrapper">
                                                <div class="jp_hiring_content_wrapper">
                                                    <img style="width: 100px; height: 100px; object-fit: cover; object-position: center;"
                                                         src="{{ isset($company->avatar_path) ? asset('storage/' . $company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                         alt="hiring_img" />
                                                    <h4>
                                                        {{ \Illuminate\Support\Str::limit($company->name, 22, '...') }}
                                                    </h4>
                                                    <p>
                                                        @if ($company->addresses->isEmpty())
                                                            Chưa cập nhật địa chỉ
                                                        @else
                                                            {{ $company->addresses->first()->province->name ?? '' }}
                                                        @endif
                                                    </p>
                                                    <ul style="display: flex; justify-content: center;">
                                                        <li>
                                                            <a
                                                                href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                                {{ $company->job_count }} bài tuyển dụng
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('listCompany') }}" method="get">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_hiring_slider_main_wrapper mt-3">
                            @csrf
                            <div class="jp_hiring_heading_wrapper">
                                <h2>Tìm kiếm</h2>
                            </div>
                            <div class="jp_hiring_slider_wrapper d-flex justify-content-center">
                                <div class="ms-3">
                                    <input type="text" placeholder="Tìm kiếm" class="form-control"
                                           style="height: 50px; width: 300px" name="search"
                                           value="{{ request()->query('search') }}">
                                </div>
                                <div class="ms-3">
                                    <select class="form-select form-control-lg" id="select2" name="province_id"
                                            style="height: 50px !important;">
                                        <option value="">Tất cả tỉnh thành</option>
                                        @foreach ($provincies as $province)
                                            <option value="{{ $province->id }}"
                                                {{ request()->query('province_id') == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ms-3">
                                    <button class="btn btn-primary" style="height: 50px">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="jp_header_form_wrapper d-flex justify-content-end">

                                    <div style="width: 125px" class="me-2">
                                        <div class="gc_causes_select_box">
                                            <select id="sortOrder" name="sort_order" style="cursor: pointer"
                                                    onchange="this.form.submit()">
                                                <option value="">Mặc định</option>
                                                <option value="asc"
                                                    {{ request()->query('sort_order') == 'asc' ? 'selected' : '' }}>
                                                    Tăng dần
                                                </option>
                                                <option value="desc"
                                                    {{ request()->query('sort_order') == 'desc' ? 'selected' : '' }}>
                                                    Giảm dần
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="">
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
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="tab-content">
                                    <div id="grid" class="tab-pane fade in active">
                                        <div class="row">
                                            @foreach ($companies as $company)
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                        <div
                                                            class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont rounded-3">
                                                            <div
                                                                class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper rounded-3">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="jp_job_post_side_img">
                                                                            <img src="{{ isset($company->avatar_path) ? asset('storage/' . $company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                                 style="object-fit: cover; width: 100%; height: 100%; object-position: center;"
                                                                                 alt="image" />
                                                                        </div>
                                                                        <div
                                                                            class="jp_job_post_right_cont jp_job_post_grid_right_cont jp_cl_job_cont">
                                                                            <h4 style="font-size: 18px">
                                                                                {{ $company->name }}</h4>
                                                                            <div class="mt-3 mb-3">
                                                                                @if ($company->addresses->isEmpty())
                                                                                    <span>
                                                                                        Chưa cập nhật địa chỉ
                                                                                    </span>
                                                                                @else
                                                                                    <i class="fa fa-map-marker"></i>&nbsp;
                                                                                    <span>{{ $company->addresses->first()->specific_address }},
                                                                                        {{ $company->addresses->first()->ward ? $company->addresses->first()->ward->name . ', ' : '' }}
                                                                                        {{ $company->addresses->first()->district ? $company->addresses->first()->district->name . ', ' : '' }}
                                                                                        {{ $company->addresses->first()->province ? $company->addresses->first()->province->name : '' }}
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                            <div
                                                                                class="jp_job_post_right_btn_wrapper jp_job_post_grid_right_btn_wrapper jp_cl_aply_btn">
                                                                                @php
                                                                                    // Đếm tổng số jobs
                                                                                    $jobCount = $company->hirings->sum(
                                                                                        function ($hiring) {
                                                                                            return $hiring->jobs->count();
                                                                                        },
                                                                                    );
                                                                                @endphp
                                                                                <ul>
                                                                                    <li>
                                                                                        <a
                                                                                            href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                                                            {{ $jobCount }} việc làm
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                                <div class="pager_wrapper gc_blog_pagination">
                                                    <ul class="pagination">
                                                        <li class="{{ $companies->onFirstPage() ? 'disabled' : '' }}">
                                                            <a href="{{ $companies->previousPageUrl() }}"><i
                                                                    class="fa fa-chevron-left"></i></a>
                                                        </li>

                                                        @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                                            <li
                                                                class="{{ $page == $companies->currentPage() ? 'active' : '' }}">
                                                                <a href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        <li class="{{ $companies->hasMorePages() ? '' : 'disabled' }}">
                                                            <a href="{{ $companies->nextPageUrl() }}"><i
                                                                    class="fa fa-chevron-right"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list" class="tab-pane fade">
                                        <div class="row">
                                            @foreach ($companies as $company)
                                                <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div
                                                            class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                            <div class="jp_job_post_main_wrapper rounded-3">
                                                                <div class="row">
                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                        <div class="jp_job_post_side_img">
                                                                            <img src="{{ isset($company->avatar_path) ? asset('storage/' . $company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                                 style="object-fit: cover; width: 100%; height: 100%; object-position: center;"
                                                                                 alt="image" />
                                                                        </div>
                                                                        <div class="jp_job_post_right_cont jp_cl_job_cont">
                                                                            <h4 style="font-size: 18px">
                                                                                {{ $company->name }}</h4>
                                                                            <div class="mt-3 mb-3">
                                                                                @if ($company->addresses->isEmpty())
                                                                                    <span>
                                                                                        Chưa cập nhật địa chỉ
                                                                                    </span>
                                                                                @else
                                                                                    <i class="fa fa-map-marker"></i>&nbsp;
                                                                                    <span>{{ $company->addresses->first()->specific_address }},
                                                                                        {{ $company->addresses->first()->ward ? $company->addresses->first()->ward->name . ', ' : '' }}
                                                                                        {{ $company->addresses->first()->district ? $company->addresses->first()->district->name . ', ' : '' }}
                                                                                        {{ $company->addresses->first()->province ? $company->addresses->first()->province->name : '' }}
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                        <div class="jp_job_post_right_btn_wrapper">
                                                                            @php
                                                                                // Đếm tổng số jobs
                                                                                $jobCount = $company->hirings->sum(
                                                                                    function ($hiring) {
                                                                                        return $hiring->jobs->count();
                                                                                    },
                                                                                );
                                                                            @endphp
                                                                            <ul>
                                                                                <li>
                                                                                    <a
                                                                                        href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                                                        {{ $jobCount }} việc làm
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                                <div class="pager_wrapper gc_blog_pagination">
                                                    <ul class="pagination">
                                                        <li class="{{ $companies->onFirstPage() ? 'disabled' : '' }}">
                                                            <a href="{{ $companies->previousPageUrl() }}"><i
                                                                    class="fa fa-chevron-left"></i></a>
                                                        </li>

                                                        @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                                            <li
                                                                class="{{ $page == $companies->currentPage() ? 'active' : '' }}">
                                                                <a href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        <li class="{{ $companies->hasMorePages() ? '' : 'disabled' }}">
                                                            <a href="{{ $companies->nextPageUrl() }}"><i
                                                                    class="fa fa-chevron-right"></i></a>
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
                </form>

            </div>
        </div>
    </div>
@endsection
@session('css')
<style>
    .select2-height-fix .select2-selection--single {
        height: 50px !important;
        padding-top: 13px;
    }
</style>
@endsession
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#select2').select2({
                allowClear: false,
                containerCssClass: "select2-height-fix",
                width: '300px'
            });
        });
    </script>
@endsection
