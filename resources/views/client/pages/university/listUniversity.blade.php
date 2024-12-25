@extends('client.layout.main')
@section('title', 'Danh sách trường học')
@section('content')
    {{-- breacrumb --}}
    <div class="jp_tittle_main_wrapper">
        <div class="jp_tittle_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_tittle_heading_wrapper">
                        <div class="jp_tittle_heading">
                            <h2>Danh sách trường học</h2>
                        </div>
                        <div class="jp_tittle_breadcrumb_main_wrapper">
                            <div class="jp_tittle_breadcrumb_wrapper">
                                <ul>
                                    <li><a href="{{ route('home') }}">{{ __('label.breadcrumb.home') }}</a> <i
                                            class="fa fa-angle-right"></i></li>
                                    <li>Trường học</li>
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

                @if ($popularUniversities)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_hiring_slider_main_wrapper">
                            <div class="jp_hiring_heading_wrapper">
                                <h2>Top trường học phổ biến</h2>
                            </div>
                            <div class="jp_hiring_slider_wrapper">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($popularUniversities as $university)
                                        <div class="item">
                                            <div class="jp_hiring_content_main_wrapper">
                                                <a href="{{ route('detailUniversity', ['slug' => $university->slug]) }}">
                                                    <div class="jp_hiring_content_wrapper">
                                                        <img style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; object-fit: cover; object-position: center; border-radius: 50%;"
                                                            src="{{ isset($university->avatar_path) ? asset('storage/' . $university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                            alt="hiring_img" />

                                                        <h4>
                                                            {{ \Illuminate\Support\Str::limit($university->name, 22, '...') }}
                                                        </h4>
                                                        <p>
                                                            @if ($university->address)
                                                                {{ $university->address->province->name ?? '' }}
                                                            @endif
                                                        </p>

                                                        <ul class="d-flex justify-content-center">
                                                            <a href="{{ route('detailUniversity', ['slug' => $university->slug]) }}"
                                                                style="background-color: #23c0e9;border-radius: 10px; padding: 5px 10px">
                                                                <label class="h6" style="color: #fff">
                                                                    {{ $university->collaborations->count() }} liên kết
                                                                </label>
                                                            </a>
                                                        </ul>

                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('listUniversity') }}" method="get">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_hiring_slider_main_wrapper mt-3">
                            @csrf
                            <div class="jp_hiring_heading_wrapper">
                                <h2>Tìm kiếm</h2>
                            </div>
                            <div class="jp_hiring_slider_wrapper d-flex justify-content-center">
                                <div class="ms-3">
                                    <input type="text" placeholder="Tìm kiếm" id="name_search"
                                        style="height: 50px; width: 300px" name="searchName"
                                        value="{{ request('searchName') }}">
                                </div>
                                <div class="ms-3">
                                    <select class="form-select form-control-lg" id="select2" name="searchProvince"
                                        style="height: 50px !important;">
                                        <option value="">Tất cả tỉnh thành</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ request('searchProvince') == $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ms-3">
                                    <button class="btn btn-primary" style="height: 50px" id="search">Tìm kiếm</button>
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('listUniversity') }}"><button class="btn btn-primary" type="button"
                                            id="removeFilter" style="height: 50px">Xóa tìm kiếm</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="jp_header_form_wrapper d-flex justify-content-end">

                                    <div style="width: 125px" class="me-2">

                                    </div>

                                    <div class="">
                                        <div class="gc_causes_view_tabs">
                                            <ul class="nav nav-pills">
                                                <li class="active"><a data-toggle="pill" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="" href="#grid"><i
                                                            class="fa fa-th-large"></i></a></li>
                                                <li><a data-toggle="pill" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="" href="#list"><i class="fa fa-list"></i></a>
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
                                            @forelse ($universities as $university)
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <a
                                                        href="{{ route('detailUniversity', ['slug' => $university->slug]) }}">
                                                        <div
                                                            class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont rounded-3">
                                                            <div
                                                                class="jp_job_post_main_wrapper jp_job_post_grid_main_wrapper rounded-3">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="jp_job_post_side_img">
                                                                            <img src="{{ isset($university->avatar_path) ? asset('storage/' . $university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                                style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 50%;"
                                                                                alt="image" />
                                                                        </div>
                                                                        <div
                                                                            class="jp_job_post_right_cont jp_job_post_grid_right_cont jp_cl_job_cont">
                                                                            <h4 style="font-size: 18px;margin-bottom: 10px">
                                                                                {{ $university->name }}</h4>
                                                                            <div class="jp_listing_list_icon">
                                                                                <i class="fa-solid fa-location-dot me-2"
                                                                                    style="color: #ff5353;"></i>
                                                                            </div>
                                                                            <span>{{ $university->address->specific_address }},
                                                                                {{ $university->address->ward ? $university->address->ward->name . ', ' : '' }}
                                                                                {{ $university->address->district ? $university->address->district->name . ', ' : '' }}
                                                                                {{ $university->address->province ? $university->address->province->name : '' }}
                                                                            </span>
                                                                            {{-- {!! Str::limit($university->description, 100, '...') !!} --}}

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @empty
                                                <p style="text-align:center ">Không tìm thấy trường học</p>
                                            @endforelse
                                            @if ($universities->lastPage() > 1)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                                    <div class="pager_wrapper gc_blog_pagination">
                                                        <ul class="pagination">
                                                            <li
                                                                class="{{ $universities->onFirstPage() ? 'disabled' : '' }}">
                                                                <a href="{{ $universities->previousPageUrl() }}"><i
                                                                        class="fa fa-chevron-left"></i></a>
                                                            </li>

                                                            @foreach ($universities->getUrlRange(1, $universities->lastPage()) as $page => $url)
                                                                <li
                                                                    class="{{ $page == $universities->currentPage() ? 'active' : '' }}">
                                                                    <a href="{{ $url }}">{{ $page }}</a>
                                                                </li>
                                                            @endforeach

                                                            <li
                                                                class="{{ $universities->hasMorePages() ? '' : 'disabled' }}">
                                                                <a href="{{ $universities->nextPageUrl() }}"><i
                                                                        class="fa fa-chevron-right"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="list" class="tab-pane fade">
                                        <div class="row">
                                            @forelse  ($universities as $university)
                                                <a href="{{ route('detailUniversity', ['slug' => $university->slug]) }}">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div
                                                            class="jp_job_post_main_wrapper_cont jp_job_post_grid_main_wrapper_cont">
                                                            <div class="jp_job_post_main_wrapper rounded-3">
                                                                <div class="row">
                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                        <div class="jp_job_post_side_img">
                                                                            <img style="width: 100px; height: 100px; object-fit: cover; object-position: center; border-radius: 50%;"
                                                                                src="{{ isset($university->avatar_path) ? asset('storage/' . $university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                                alt="hiring_img" />
                                                                        </div>
                                                                        <div class="jp_job_post_right_cont jp_cl_job_cont">
                                                                            <h4
                                                                                style="font-size: 18px;margin-bottom: 10px">
                                                                                {{ $university->name }}</h4>
                                                                            {{-- {!! Str::limit($university->description, 100, '...') !!} --}}
                                                                            <i class="fa-solid fa-location-dot me-2"
                                                                                style="color: #ff5353;"></i>
                                                                            <span>{{ $university->address->specific_address }},
                                                                                {{ $university->address->ward ? $university->address->ward->name . ', ' : '' }}
                                                                                {{ $university->address->district ? $university->address->district->name . ', ' : '' }}
                                                                                {{ $university->address->province ? $university->address->province->name : '' }}
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="jp_job_post_right_btn_wrapper text-center">
                                                                        <ul class="list-unstyled m-0">
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @empty
                                                <p style="text-align:center ">Không tìm thấy trường học</p>
                                            @endforelse
                                            @if ($universities->lastPage() > 1)
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                                                    <div class="pager_wrapper gc_blog_pagination">
                                                        <ul class="pagination">
                                                            <li
                                                                class="{{ $universities->onFirstPage() ? 'disabled' : '' }}">
                                                                <a href="{{ $universities->previousPageUrl() }}"><i
                                                                        class="fa fa-chevron-left"></i></a>
                                                            </li>

                                                            @foreach ($universities->getUrlRange(1, $universities->lastPage()) as $page => $url)
                                                                <li
                                                                    class="{{ $page == $universities->currentPage() ? 'active' : '' }}">
                                                                    <a href="{{ $url }}">{{ $page }}</a>
                                                                </li>
                                                            @endforeach

                                                            <li
                                                                class="{{ $universities->hasMorePages() ? '' : 'disabled' }}">
                                                                <a href="{{ $universities->nextPageUrl() }}"><i
                                                                        class="fa fa-chevron-right"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
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

@section('css')
    <link rel="stylesheet" href="{{ asset('clients/css/custom.css') }}">
@endsection

@section('js')
    <script>
        window.addEventListener("beforeunload", function() {
            localStorage.setItem("scrollPosition", window.scrollY);
        });


        window.addEventListener("load", function() {
            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition, 10));
                localStorage.removeItem("scrollPosition");
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            $('#select2').select2({
                allowClear: false,
                containerCssClass: "select2-height-fix",
                width: '300px'
            });

            const activeTab = localStorage.getItem("activeTab");
            if (activeTab) {
                document.querySelector(`a[href="${activeTab}"]`).click();
            }

            const tabs = document.querySelectorAll('.nav-pills a');
            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    localStorage.setItem("activeTab", this.getAttribute("href"));
                });
            });
        });

        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection
