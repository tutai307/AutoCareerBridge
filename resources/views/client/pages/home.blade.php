@extends('client.layout.main')
@section('title', 'Trang chủ')

@section('content')
    {{-- @include('client.pages.searchForm') --}}
    <div class="jp_img_wrapper">
        <div class="jp_slide_img_overlay"></div>
        <div class="jp_banner_heading_cont_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_job_heading_wrapper">
                            <div class="jp_job_heading">
                                <h1><span>3,000+</span> Cơ hội nghề nghiệp hấp dẫn</h1>
                                <p>Khám phá công việc mơ ước, phát triển sự nghiệp của bạn ngay hôm nay!</p>
                            </div>
                        </div>
                    </div>
                    @include('client.pages.components.search.searchForm')
                </div>
            </div>
        </div>
    </div>

    <div class="jp_first_sidebar_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        @if (
                            !auth()->guard('admin')->check() ||
                                (auth()->guard('admin')->check() &&
                                    (auth()->guard('admin')->user()->role === ROLE_UNIVERSITY ||
                                        auth()->guard('admin')->user()->role === ROLE_SUB_UNIVERSITY)))
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="jp_hiring_slider_main_wrapper">
                                    <div class="jp_hiring_heading_wrapper">
                                        <h2>Top doanh nghiệp</h2>
                                    </div>

                                    <div class="jp_hiring_slider_wrapper">
                                        <div class="owl-carousel owl-theme">
                                            @foreach ($companies as $company)
                                                <div class="item">
                                                    <div class="jp_hiring_content_main_wrapper">
                                                        <div class="jp_hiring_content_wrapper">
                                                            <a
                                                                href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                                <img src="{{ isset($company->avatar_path) ? asset($company->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                    alt="hiring_img"
                                                                    style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; object-fit: cover; border-radius:15px;" />
                                                                <a
                                                                    href="{{ route('detailCompany', ['slug' => $company->slug]) }}">
                                                                    <h4> {{ \Illuminate\Support\Str::limit($company->name, 15, '...') }}
                                                                    </h4>
                                                                </a>
                                                                <p>
                                                                    @if (!$company->addresses->isEmpty())
                                                                        {{ $company->addresses->first()->province->name ?? '' }}
                                                                    @endif
                                                                </p>
                                                                <ul class="d-flex justify-content-center">
                                                                    <li>
                                                                        <a href="{{ route('detailCompany', ['slug' => $company->slug]) }}"
                                                                            style="background-color: #23c0e9;">
                                                                            {{ $company->jobs_count }} bài tuyển dụng
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

                        @if (
                            !auth()->guard('admin')->check() ||
                                (auth()->guard('admin')->check() &&
                                    (auth()->guard('admin')->user()->role === ROLE_COMPANY ||
                                        auth()->guard('admin')->user()->role === ROLE_HIRING)))
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                                <div class="jp_hiring_slider_main_wrapper">
                                    <div class="jp_hiring_heading_wrapper">
                                        <h2>Top trường học</h2>
                                    </div>

                                    <div class="jp_hiring_slider_wrapper">
                                        <div class="owl-carousel owl-theme">
                                            @foreach ($universities as $university)
                                                <div class="item">
                                                    <div class="jp_hiring_content_main_wrapper">
                                                        <a
                                                            href="{{ route('detailUniversity', ['slug' => $university->slug]) }}">
                                                            <div class="jp_hiring_content_wrapper">
                                                                <img src="{{ isset($university->avatar_path) ? asset('storage/' . $university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                    alt="hiring_img"
                                                                    style="width: 100px; height: 100px; max-width: 100px; max-height: 100px; object-fit: cover;border-radius: 50%;" />
                                                                <h4> {{ \Illuminate\Support\Str::limit($university->name, 15, '...') }}
                                                                </h4>
                                                                <p>
                                                                    @if (!$university->address->null)
                                                                        {{ $university->address->province->name ?? '' }}
                                                                    @endif
                                                                </p>
                                                                <ul class="d-flex justify-content-center">
                                                                    <a href="{{ route('detailUniversity', ['slug' => $university->slug]) }}"
                                                                        style="background-color: #23c0e9;border-radius: 10px; padding: 5px 10px">
                                                                        <label class="h6" style="color: #fff">
                                                                            {{ $university->collaborations->count() }}
                                                                            liên
                                                                            kết
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
                        {{-- Section jobs recently --}}
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="jp_listing_related_heading_wrapper">
                                <h2>Công việc mới</h2>
                                <div class="jp_listing_related_slider_wrapper mb-5">
                                    <div class="item">
                                        <div class="row">
                                            @foreach ($newJobs as $job)
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"
                                                    style="padding-bottom: 30px;">
                                                    <div class="jp_job_post_main_wrapper_cont">
                                                        <div class="jp_job_post_main_wrapper">
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                                                                    <a
                                                                        href="{{ route('detailJob', ['slug' => $job->slug]) }}">
                                                                        <div class="jp_job_post_side_img">
                                                                            <img data-bs-toggle="tooltip"
                                                                                title="{{ $job->name }}"
                                                                                src="{{ asset($job->company->avatar_path) }}"
                                                                                alt="{{ $job->name }}">
                                                                        </div>
                                                                        <div class="jp_job_post_right_cont">
                                                                            <h4 data-bs-toggle="tooltip"
                                                                                title="{{ ucfirst($job->name) }}">
                                                                                {{ str()->limit(ucwords($job->name), 45) }}
                                                                            </h4>
                                                                            <a href="{{ route('detailCompany', ['slug' => $job->company->slug]) }}"
                                                                                data-bs-toggle="tooltip"
                                                                                title="{{ $job->company->name }}">
                                                                                <p style="color:#e69920;">
                                                                                    {{ ucfirst($job->company->name) }}</p>
                                                                            </a>
                                                                            <ul>
                                                                                @if (!empty($job->salary_min) && !empty($job->salary_max))
                                                                                    <li><i
                                                                                            class="fa fa-cc-paypal"></i>&nbsp;
                                                                                        ${{ $job->salary_min }} -
                                                                                        ${{ $job->salary_max }} P.A.
                                                                                    </li>
                                                                                @endif
                                                                                @if (!empty($job->company->addresses->first()->province->name))
                                                                                    <li data-bs-toggle="tooltip"
                                                                                        title="{{ ucwords($job->company->addresses->first()->province->name) }}, {{ ucwords($job->company->addresses->first()->district->name) }}">
                                                                                        <i class="fa-solid fa-location-dot me-2"
                                                                                            style="color: #ff5353;"></i>&nbsp;
                                                                                        {{ ucwords($job->company->addresses->first()->province->name) }}
                                                                                    </li>
                                                                                @endif
                                                                            </ul>
                                                                            <span class="mt-1">
                                                                                Còn
                                                                                <b>{{ \Carbon\Carbon::parse($job->end_date)->startOfDay()->diffInDays(now()->startOfDay()) }}</b>
                                                                                ngày để ứng tuyển
                                                                            </span>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="jp_job_post_right_btn_wrapper">
                                                                        <ul>
                                                                            <li>
                                                                                <a width="140px"
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
                                            @endforeach
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
    <!-- jp first sidebar Wrapper End -->

    <!-- jp counter Wrapper Start -->
    <div class="jp_counter_main_wrapper">
        <div class="container">
            <div class="gc_counter_cont_wrapper">
                <div class="count-description">
                    <span class="timer">{{ $countJob ?? 0 }}</span><i class="fa fa-plus"></i>
                    <h5 class="con1">Việc làm</h5>
                </div>
            </div>
            <div class="gc_counter_cont_wrapper2">
                <div class="count-description">
                    <span class="timer">{{ $countWorkshop ?? 0 }}</span><i class="fa fa-plus"></i>
                    <h5 class="con2">Workshop</h5>
                </div>
            </div>
            <div class="gc_counter_cont_wrapper3">
                <div class="count-description">
                    <span class="timer">{{ $countUniversity ?? 0 }}</span><i class="fa fa-plus"></i>
                    <h5 class="con3">Trường học</h5>
                </div>
            </div>
            <div class="gc_counter_cont_wrapper4">
                <div class="count-description">
                    <span class="timer">{{ $countCompany ?? 0 }}</span><i class="fa fa-plus"></i>
                    <h5 class="con4">Doanh nghiệp</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- jp counter Wrapper End -->
    <!-- jp Workshop Start -->
    @isset($workShopHot)
        <div class="jp_career_main_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="jp_hiring_slider_main_wrapper">
                            <div class="jp_career_slider_heading_wrapper">
                                <h2>Workshop</h2>
                            </div>
                            <div class="jp_career_slider_wrapper">
                                <div class="owl-carousel owl-theme">
                                    @foreach ($workShopHot as $item)
                                        <div class="item jp_recent_main">
                                            <div class="jp_career_main_box_wrapper" style="height: 340px;">
                                                <div class="jp_career_img_wrapper">
                                                    <a href="{{ route('detailWorkShop', ['slug' => $item->slug]) }}">
                                                        <img style="width: 100%; height: 200px;"
                                                            src="{{ $item->avatar_path ? asset($item->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                            alt="{{ $item->name }}" />
                                                    </a>
                                                </div>
                                                <div class="jp_career_cont_wrapper">
                                                    <p><i class="fa fa-calendar"></i>&nbsp;&nbsp;
                                                        {{ $item->start_date }}</p>
                                                    <h3><a href="{{ route('detailWorkShop', ['slug' => $item->slug]) }}"
                                                            title="{{ $item->name }}"
                                                            data-to>{{ Str::limit($item->name, 20, '...') }}</a>
                                                    </h3>
                                                </div>
                                            </div>
                                            @if ($item->university)
                                                <div class="jp_career_slider_bottom_cont">
                                                    <ul>
                                                        <li>
                                                            <img style="width: 50px; height: 50px; max-width: 50px; max-height: 50px; border-radius: 50%; object-fit: cover;"
                                                                src="{{ $item->university->avatar_path ? asset('storage/' . $item->university->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                                                alt="{{ $item->university->name }}"
                                                                class="img-circle">&nbsp;&nbsp; <a
                                                                href="{{ route('detailUniversity', ['slug' => $item->university->slug]) }}">{{ Str::limit($item->university->name, 30, '...') }}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <!-- jp Workshop End -->
    <!-- jp Client Wrapper Start -->
    <div class="jp_client_slider_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="jp_first_client_slider_wrapper">
                        <div class="jp_first_client_slider_img_overlay"></div>
                        <div class="jp_client_heading_wrapper">
                            <h2>Báo chí nói gì về JobPro?</h2>
                        </div>
                        <div class="jp_client_slider_wrapper">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="jp_client_slide_show_wrapper">
                                        <div class="jp_client_slider_img_wrapper">
                                            <img src="https://www.vietnamworks.com/_next/image?url=https%3A%2F%2Fimages.vietnamworks.com%2Flogo%2Fthanhnien.png&w=1920&q=75"
                                                alt="client_img" />
                                        </div>
                                        <div class="jp_client_slider_cont_wrapper">
                                            <p>"Hành trình sự nghiệp hạnh phúc’ chạm đến hàng triệu người Việt"</p>
                                            <span>Khép lại chiến dịch tái định vị thương hiệu, VietnamWorks đã cùng người
                                                lao động Việt Nam bước sang trang mới của xu hướng nhân sự toàn cầu với sứ
                                                mệnh Empower growth - Hành trình sự nghiệp hạnh phúc.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="jp_client_slide_show_wrapper">
                                        <div class="jp_client_slider_img_wrapper">
                                            <img src="https://www.vietnamworks.com/_next/image?url=https%3A%2F%2Fimages.vietnamworks.com%2Flogo%2Ftien-phong.png&w=1920&q=75"
                                                alt="client_img" />
                                        </div>
                                        <div class="jp_client_slider_cont_wrapper">
                                            <p>JobPro tổ chức Job Fair - ngày hội việc làm lớn nhất năm 2022”</p>
                                            <span>Trang tìm kiếm việc làm trực tuyến VietnamWorks thuộc Navigos Group sẽ tổ
                                                chức Job Fair 2022 với tên gọi “Growth Adventure - Find Your Perfect Match”
                                                tại TP. Hồ Chí Minh và Hà Nội.~ Jeniffer Doe
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="jp_client_slide_show_wrapper">
                                        <div class="jp_client_slider_img_wrapper">
                                            <img src="https://www.vietnamworks.com/_next/image?url=https%3A%2F%2Fimages.vietnamworks.com%2Flogo%2Flaodong.png&w=1920&q=75"
                                                alt="client_img" />
                                        </div>
                                        <div class="jp_client_slider_cont_wrapper">
                                            <p>JobPro thay đổi nhận diện thương hiệu, công bố sứ mệnh mới</p>
                                            <span>Vừa qua, VietnamWorks thuộc tập đoàn cung cấp dịch vụ tuyển dụng nhân sự
                                                hàng đầu Navigos Group công bố nhận diện thương hiệu và tập trung vào sứ
                                                mệnh mới hướng đến một “Hành Trình Sự Nghiệp Hạnh Phúc”</span>
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
    <!-- jp Client Wrapper End -->

@endsection
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("key_search");
            const clearBtn = document.getElementById("clear_btn");

            clearBtn.addEventListener("click", () => {
                searchInput.value = "";
                searchInput.dispatchEvent(new Event("input")); // Kích hoạt sự kiện input
                searchInput.focus(); // Để người dùng tiếp tục nhập liệu
            });
        });
    </script>
@endsection
