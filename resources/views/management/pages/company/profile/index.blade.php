@extends('management.layout.main')

@section('title', 'Thông tin doanh nghiệp')

@section('content')

    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="page-titles">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('label.breadcrumb.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('label.breadcrumb.profile') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            @if (!empty($companyProfile->address->map))
                                <iframe width="100%" height="300" style="border:0"
                                    src="https://www.google.com/maps?q={{ $companyProfile->address->map }}&output=embed"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <div class="cover-photo rounded"></div>
                            @endif
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="{{ isset($companyProfile->avatar_path) ? asset($companyProfile->avatar_path) : asset('management-assets/images/no-img-avatar.png') }}"
                                    class="rounded-circle" style="width: 110px; height: 110px; object-fit: cover;"
                                    alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ $companyProfile->name ?? '' }}</h4>
                                    <p>{{ __('label.admin.company') }}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ $companyProfile->user->email ?? '' }}</h4>
                                    <p>{{ __('label.auth.email') }}</p>
                                </div>
                                <div class="dropdown ms-auto">
                                    <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown" title="Mở menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                            </g>
                                        </svg>
                                    </div>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li class="dropdown-item" title="Cập nhật hồ sơ">
                                            @if (isset($companyProfile->slug) && $companyProfile->slug)
                                                <a href="{{ route('company.profileEdit', ['slug' => $companyProfile->slug]) }}"
                                                    title="Chỉnh sửa hồ sơ công ty">
                                                    <i class="fa-solid fa-pen-to-square text-primary me-2"></i>
                                                    {{ __('label.breadcrumb.update_profile') }}
                                                </a>
                                            @else
                                                <span class="text-muted" title="Không thể chỉnh sửa hồ sơ">
                                                    <i class="fa-solid fa-pen-to-square text-muted me-2"></i>
                                                    {{ __('label.breadcrumb.update_profile') }}
                                                </span>
                                            @endif
                                        </li>
                                        <li class="dropdown-item" title="Quản lý nhân viên">
                                            <a href="{{ route('company.manageHiring') }}" title="Xem và quản lý nhân viên">
                                                <i class="fa fa-plus text-primary me-2"></i>
                                                {{ __('label.admin.profile.staff_manager') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="{{ $companyProfile->jobs->count() > 0 ? 'col-xl-4' : 'd-none' }}">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-news">
                                    <h5 class="text-primary d-inline">{{ __('label.admin.profile.list_jobs') }}</h5>
                                    @foreach ($companyProfile->jobs as $job)
                                        <a href="{{ route('company.showJob', ['slug' => $job->slug]) }}">
                                            <div class="media pt-3 pb-3">
                                                <img src="{{ asset($job->company->avatar_path) ?? asset('management-assets/images/no-img-avatar.png') }}"
                                                    alt="image" class="me-3 rounded" width="85" height="85"
                                                    object-fit="cover">
                                                <div class="media-body">
                                                    <h5 class="m-b-5">{{ $job->name }}
                                                    </h5>
                                                    <p><strong>{{ __('label.admin.profile.end_date') }}: </strong>
                                                        {{ $job->end_date }}</p>
                                                    <p class="mb-0">
                                                        {!! Str::limit($job->detail, 30) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="m-0" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="{{ $companyProfile->jobs->count() > 0 ? 'col-xl-8' : 'col-xl-12' }}">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <h5 class="text-primary">{{ __('label.admin.profile.information') }}</h5>
                                <div class="tab-content">
                                    <div id="about-me" class="tab-pane fade active show">
                                        <div class="profile-about-me">
                                            <div class="border-bottom-1">
                                                <h5 class="text-primary">{{ __('label.admin.profile.about') }}</h5>
                                                <p class="mb-1">
                                                    {!! $companyProfile->about ?? '' !!}
                                                </p>
                                            </div>
                                            <div class="border-bottom-1">
                                                <h5 class="text-primary ">{{ __('label.admin.profile.description') }}</h5>
                                                <p class="mb-1">
                                                    {!! $companyProfile->description ?? '' !!}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="profile-personal-info">
                                            <h5 class="text-primary mb-2">
                                                {{ __('label.admin.profile.information_detail') }}</h5>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.last_updated') }}
                                                        <span class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    <span>{{ $companyProfile->updated_at ?? '' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.name') }} <span
                                                            class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    <span>{{ $companyProfile->name ?? '' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.auth.email') }} <span
                                                            class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    <span>{{ $companyProfile->user->email ?? '' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.size') }}<span
                                                            class="pull-end">:</span></h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    @if (isset($companyProfile->size))
                                                        <span>{{ $companyProfile->size ?? '' }}
                                                            {{ __('label.admin.profile.member') }}</span>
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.phone') }}<span
                                                            class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    <span>{{ $companyProfile->phone ?? '' }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.web_link') }}<span
                                                            class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    <a href="{{ $companyProfile->website_link ?? '#' }}" color="primary"
                                                        target="_blank">{{ $companyProfile->website_link ?? '' }}</a>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.field') }}<span
                                                            class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7">
                                                    @if ($companyProfile->fields)
                                                        @foreach ($companyProfile->fields as $index => $field)
                                                            <span>{{ $field->name }}@if ($index < count($companyProfile->fields) - 1)
                                                                    ,
                                                                @endif </span>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-3 col-5">
                                                    <h5 class="f-w-500">{{ __('label.admin.profile.address') }} <span
                                                            class="pull-end">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9 col-7"><span>
                                                        {{ $companyProfile->address->specific_address ?? '' }}
                                                        @if (!empty($companyProfile->address->ward))
                                                            , {{ $companyProfile->address->ward->name }}
                                                        @endif
                                                        @if (!empty($companyProfile->address->district))
                                                            , {{ $companyProfile->address->district->name }}
                                                        @endif
                                                        @if (!empty($companyProfile->address->province))
                                                            , {{ $companyProfile->address->province->name }}
                                                        @endif
                                                    </span>

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
@section('js')
@endsection
