@extends('home.layouts.app')
@section('title', $job->name)
@section('content')
    <div class="container-xxl bg-white p-0">
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row gy-5 gx-4">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center mb-5">
                            <img class="flex-shrink-0 img-fluid border rounded" src="{{ asset($job->company->avatar_path) }}"
                                alt="" style="width: 80px; height: 80px;">
                            <div class="text-start ps-4">
                                <h3 class="mb-3">{{ $job->name }}</h3>
                                <span class="text-truncate me-3"><i
                                        class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->company->addresses->first()->province->name ?? 'Chưa cập nhật' }}</span>
                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>Thỏa
                                    thuận</span>
                            </div>
                        </div>

                        <div class="mb-5">
                            <div class="job-description">
                                {!! $job->detail ?? 'Chưa cập nhật nội dung' !!}
                            </div>
                        </div>

                        <div class="">
                            <div class="row g-3">
                                <div class="col-12">
                                    @if (Auth::guard('student')->check())
                                        @if($job->applications()->where('student_code', Auth::guard('student')->id())->exists())
                                            <button class="btn btn-secondary w-100" disabled>
                                                Đã ứng tuyển
                                            </button>
                                        @else
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                                data-bs-target="#applyModal">
                                                Nộp hồ sơ ứng tuyển
                                            </button>
                                            {{-- Thêm component uploadCV --}}
                                            @include('home.components.uploadCV')
                                        @endif
                                    @else
                                        <a href="{{ route('home.showLoginForm') }}" class="btn btn-primary w-100">
                                            Nộp hồ sơ ứng tuyển
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4">Thông tin việc làm</h4>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Ngày đăng:
                                {{ $job->created_at ? \Carbon\Carbon::parse($job->created_at)->format('d/m/Y') : 'Chưa cập nhật' }}
                            </p>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Ưu tiên chuyên ngành:
                                {{ $job->major->name ?? 'Chưa cập nhật' }}</p>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Hình thức: Toàn thời gian</p>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Mức lương: Thỏa thuận</p>
                            <p><i class="fa fa-angle-right text-primary me-2"></i>Địa điểm:
                                {{ $job->company->addresses->first()->province->name ?? 'Chưa cập nhật' }}</p>
                            <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Hạn nộp:
                                {{ $job->end_date ? \Carbon\Carbon::parse($job->end_date)->format('d/m/Y') : 'Chưa cập nhật' }}
                            </p>
                        </div>
                        <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4">Kỹ năng yêu cầu</h4>
                            @if ($job->skills->count() > 0)
                                @foreach ($job->skills as $skill)
                                    <p><i class="fa fa-angle-right text-primary me-2"></i>{{ $skill->name }}</p>
                                @endforeach
                            @else
                                <p><i class="fa fa-angle-right text-primary me-2"></i>Chưa cập nhật</p>
                            @endif
                        </div>
                        <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                            <h4 class="mb-4">Thông tin công ty</h4>
                            <p class="m-0">{{ $job->company->name ?? 'Chưa cập nhật' }}</p>
                            <p class="m-0">Quy mô: {{ $job->company->size ?? 'Chưa cập nhật' }}</p>
                            <p class="m-0">Địa chỉ: {{ $job->company->addresses->first()->specific_address ?? '' }},
                                {{ $job->company->addresses->first()->ward->name ?? '' }},
                                {{ $job->company->addresses->first()->district->name ?? '' }},
                                {{ $job->company->addresses->first()->province->name ?? 'Chưa cập nhật' }}</p>
                            <p class="m-0">Website: <a
                                    href="{{ $job->company->website_link ?? '#' }}">{{ $job->company->website_link ?? 'Chưa cập nhật' }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('css')
        <style>
            .job-description {
                font-family: Arial, sans-serif;
                line-height: 1.6;
            }

            .job-description h1,
            .job-description h2,
            .job-description h3,
            .job-description h4 {
                margin-top: 15px;
                margin-bottom: 10px;
            }

            .job-description ul {
                padding-left: 20px;
            }

            .job-description p {
                margin-bottom: 10px;
            }
        </style>
    @endsection
