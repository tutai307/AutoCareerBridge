@extends('home.layouts.app')

@section('title', 'Auto Carrer Bridge - ACB')

@section('content')
    <div class="container-xxl bg-white p-0">
        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('home/img/carousel-1.jpg') }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Tìm kiếm việc làm phù hợp với bạn</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Xây dựng tương lai sự nghiệp vững chắc cùng Auto Career Bridge. Chúng tôi kết nối sinh viên tài năng với doanh nghiệp uy tín, tạo cơ hội phát triển nghề nghiệp bền vững ngay từ khi còn đi học.</p>
                                    <a href="#search"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Tìm kiếm việc làm</a>
                                    <a href="{{route('management.login')}}" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Đăng nhập tìm kiếm ứng viên</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('home/img/carousel-2.jpg') }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Hệ thống cầu nối việc làm giữa nhà trường và doanh nghiệp</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Auto Career Bridge là hệ thống cầu nối giữa nhà trường và doanh nghiệp, giúp sinh viên tìm kiếm việc làm phù hợp với khả năng và sở thích của mình.</p>
                                    <a href="#search"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Tìm kiếm việc làm</a>
                                    <a href="{{route('management.register')}}" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Đăng ký tìm kiếm ứng viên</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Search Start -->
        {{-- <div id="search" class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0" placeholder="Từ khóa" />
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0">
                                    <option selected>Ngành nghề</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0">
                                    <option selected>Địa điểm</option>
                                    <option value="1">Location 1</option>
                                    <option value="2">Location 2</option>
                                    <option value="3">Location 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Các ngành nghề phổ biến</h1>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                            <h6 class="mb-3">Marketing</h6>
                            <p class="mb-0">123 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                            <h6 class="mb-3">Dịch vụ khách hàng</h6>
                            <p class="mb-0">23 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                            <h6 class="mb-3">Nhân sự</h6>
                            <p class="mb-0">12 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-tasks text-primary mb-4"></i>
                            <h6 class="mb-3">Quản lý dự án</h6>
                            <p class="mb-0">46 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-chart-line text-primary mb-4"></i>
                            <h6 class="mb-3">Kinh doanh</h6>
                            <p class="mb-0">34 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-hands-helping text-primary mb-4"></i>
                            <h6 class="mb-3">Sales & Giao tiếp</h6>
                            <p class="mb-0">32 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-book-reader text-primary mb-4"></i>
                            <h6 class="mb-3">Giảng dạy & Giáo dục</h6>
                            <p class="mb-0">43 việc làm</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-drafting-compass text-primary mb-4"></i>
                            <h6 class="mb-3">Thiết kế & Sáng tạo</h6>
                            <p class="mb-0">53 việc làm</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End -->


        <!-- About Start -->
        <div id="about" class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-6 text-start">
                                <img class="img-fluid w-100" src="{{asset('home/img/about-1.jpg')}}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid" src="{{asset('home/img/about-2.jpg')}}" style="width: 85%; margin-top: 15%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid" src="{{asset('home/img/about-3.jpg')}}" style="width: 85%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="{{asset('home/img/about-4.jpg')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Chúng tôi giúp bạn tìm kiếm việc làm tốt nhất và tìm kiếm ứng viên</h1>
                        <p class="mb-4">Auto Career Bridge là hệ thống cầu nối giữa nhà trường và doanh nghiệp, giúp sinh viên tìm kiếm việc làm phù hợp với khả năng và sở thích của mình.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Tìm kiếm việc làm phù hợp với khả năng và sở thích của mình</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Tìm kiếm ứng viên phù hợp với yêu cầu của doanh nghiệp</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Tạo cơ hội phát triển nghề nghiệp bền vững ngay từ khi còn đi học</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Tìm hiểu thêm</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Jobs Start -->
        <div id="jobMatching" class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Đề xuất việc làm cho bạn</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        {{-- <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                                href="#tab-1">
                                <h6 class="mt-n1 mb-0">Việc làm mới</h6>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-bs-toggle="pill"
                                href="#tab-2">
                                <h6 class="mt-n1 mb-0">Doanh nghiệp hợp tác</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3 active" data-bs-toggle="pill"
                                href="#tab-3">
                                <h6 class="mt-n1 mb-0">Phù hợp với bạn</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        {{-- <div id="tab-1" class="tab-pane fade show p-0 active">
                            @forelse($jobs as $job)
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded"
                                             src="{{ asset($job->company->avatar_path) }}"
                                             alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">{{ $job->name }}</h5>
                                            <span class="text-truncate me-3">
                                                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                {{ $job->company->addresses[0]->province->name ?? 'Chưa cập nhật' }}
                                            </span>
                                            <span class="text-truncate me-3">
                                                <i class="fas fa-building text-primary me-2"></i>
                                                {{ $job->company->name }}
                                            </span>
                                            <span class="text-truncate me-3">
                                                <i class="fas fa-tools text-primary me-2"></i>
                                                @foreach($job->skills as $skill)
                                                    {{ $skill->name }}@if(!$loop->last), @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-light btn-square me-3" href="">
                                                <i class="far fa-heart text-primary"></i>
                                            </a>
                                            <a class="btn btn-primary" href="{{ route('home.detailJob', $job->slug) }}">Ứng tuyển ngay</a>
                                        </div>
                                        <small class="text-truncate">
                                            <i class="far fa-calendar-alt text-primary me-2"></i>
                                            Hạn nộp: {{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center">
                                <p>Không có việc làm nào phù hợp</p>
                            </div>
                            @endforelse

                            @if($jobs->count() > 0)
                            <div class="text-center">
                                <a class="btn btn-primary py-3 px-5" href="{{ route('search') }}">Xem thêm việc làm</a>
                            </div>
                            @endif
                        </div> --}}
                        <div id="tab-2" class="tab-pane fade">
                            @auth('student')
                                @forelse($recommendedJobs as $job)
                                <div class="job-item p-4 mb-4">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <img class="flex-shrink-0 img-fluid border rounded"
                                                 src="{{ asset($job->company->avatar_path) }}"
                                                 alt="" style="width: 80px; height: 80px;">
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3">{{ $job->name }}</h5>
                                                <span class="text-truncate me-3">
                                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                    {{ $job->company->addresses[0]->province->name ?? 'Chưa cập nhật' }}
                                                </span>
                                                <span class="text-truncate me-3">
                                                    <i class="fas fa-building text-primary me-2"></i>
                                                    {{ $job->company->name }}
                                                </span>
                                                <span class="text-truncate me-3">
                                                    <i class="fas fa-tools text-primary me-2"></i>
                                                    @foreach($job->skills as $skill)
                                                        {{ $skill->name }}@if(!$loop->last), @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-light btn-square me-3" href="">
                                                    <i class="far fa-heart text-primary"></i>
                                                </a>
                                                <a class="btn btn-primary" href="{{ route('home.detailJob', $job->slug) }}">Ứng tuyển ngay</a>
                                            </div>
                                            <small class="text-truncate">
                                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                                Hạn nộp: {{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center">
                                    Chưa có việc làm phù hợp
                                </div>
                                @endforelse
                            @else
                                <div class="text-center">
                                    <a class="btn btn-primary py-3 px-5" href="{{ route('home.showLoginForm') }}">Vui lòng đăng nhập để xem việc làm phù hợp với bạn</a>
                                </div>
                            @endauth
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0 active">
                            @auth('student')
                                @forelse($suitableJobs as $job)
                                <div class="job-item p-4 mb-4">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <img class="flex-shrink-0 img-fluid border rounded"
                                                 src="{{ asset($job->company->avatar_path) }}"
                                                 alt="" style="width: 80px; height: 80px;">
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3">{{ $job->name }}</h5>
                                                <span class="text-truncate me-3">
                                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                                    {{ $job->company->addresses[0]->province->name ?? 'Chưa cập nhật' }}
                                                </span>
                                                <span class="text-truncate me-3">
                                                    <i class="fas fa-building text-primary me-2"></i>
                                                    {{ $job->company->name }}
                                                </span>
                                                <span class="text-truncate me-3">
                                                    <i class="fas fa-tools text-primary me-2"></i>
                                                    @foreach($job->skills as $skill)
                                                        {{ $skill->name }}@if(!$loop->last), @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-light btn-square me-3" href="">
                                                    <i class="far fa-heart text-primary"></i>
                                                </a>
                                                <a class="btn btn-primary" href="{{ route('home.detailJob', $job->slug) }}">Ứng tuyển ngay</a>
                                            </div>
                                            <small class="text-truncate">
                                                <i class="far fa-calendar-alt text-primary me-2"></i>
                                                Hạn nộp: {{ \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center">
                                    Chưa có công việc phù hợp
                                </div>
                                @endforelse
                            @else
                                <div class="text-center">
                                    <a class="btn btn-primary py-3 px-5" href="{{ route('home.showLoginForm') }}">Vui lòng đăng nhập để xem việc làm phù hợp với bạn</a>
                                </div>
                            @endauth
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


        <!-- Testimonial Start -->
        <div id="fakeChat" class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <h1 class="text-center mb-5">Khách hàng nói gì về chúng tôi</h1>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Em rất biết ơn nhà trường vì đã tạo cơ hội để em tìm kiếm việc làm phù hợp với khả năng và sở thích của mình.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{asset('home/img/testimonial-1.jpg')}}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Nguyễn Ngọc Tú Tài</h5>
                                <small>Sinh viên ĐHCNHN</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Hệ thống này giúp doanh nghiệp chúng tôi tìm kiếm được những sinh viên tài năng, đáng tin cậy và phù hợp với yêu cầu của doanh nghiệp.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{asset('home/img/testimonial-2.jpg')}}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Vương Văn Huy</h5>
                                <small>Giám đốc Công ty TNHH Tân Đại</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Với cương vị của hiệu trưởng, tôi rất hài lòng với hệ thống này. Hệ thống cải thiện đáng kế hợp tác doanh nghiệp với nhà trường. Hơn nữa, tôi có thể tìm được nhiều doanh nghiệp phù hợp với nhu cầu của sinh viên.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{asset('home/img/testimonial-3.jpg')}}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Nguyễn Văn Tú</h5>
                                <small>Hiệu trưởng Trường Đại học Công nghệ Hà Nội</small>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p>Mục đích của hệ thống là tạo ra một môi trường thuận lợi cho sinh viên tìm kiếm việc làm phù hợp với khả năng và sở thích của mình. Tôi rất vui vì tạo ra được lợi ích cho cả sinh viên và doanh nghiệp.
                        </p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{asset('home/img/testimonial-4.jpg')}}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">Admin Auto Career Bridge</h5>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
@endsection
