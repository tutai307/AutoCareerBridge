@extends('management.layout.main')

@section('title', 'Quản lý doanh nghiệp tham gia workshop')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('company.home') }}">{{ __('label.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('label.university.applyWorkshop.manage_applied_workshops') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                            </div>
                            <div class="custom-tab-1" id="collaboration-container">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->get('tab') == 'pending' ? 'active' : '' }}"
                                            href="{{ url()->current() }}?tab=pending">
                                            <i class="la la-code-branch mx-2"></i>{{ __('label.university.applyWorkshop.pending') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->get('tab') == 'approved' ? 'active' : '' }}"
                                            href="{{ url()->current() }}?tab=approved">
                                            <i class="la la-check-circle mx-2"></i>{{ __('label.university.applyWorkshop.approved') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->get('tab') == 'rejected' ? 'active' : '' }}"
                                            href="{{ url()->current() }}?tab=rejected">
                                            <i class="la la-times-circle mx-2"></i>{{ __('label.university.applyWorkshop.rejected') }}
                                        </a>
                                    </li>
                                </ul>

                                <!-- Nội dung của các tab -->
                                <div class="tab-content">
                                    <div class="tab-pane fade {{ request()->get('tab') == 'pending' ? 'show active' : '' }}"
                                        id="pending">
                                        <div id="pending-content">
                                             @include('management.pages.university.company_workshop.table', [
                                                'data' => $pending,
                                            ])
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ request()->get('tab') == 'approved' ? 'show active' : '' }}"
                                        id="approved">
                                        <div id="approved-content">
                                            @include('management.pages.university.company_workshop.table', [
                                                'data' => $approved,
                                            ])
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ request()->get('tab') == 'rejected' ? 'show active' : '' }}"
                                        id="rejected">
                                        <div id="rejected-content">
                                            @include('management.pages.university.company_workshop.table', [
                                                'data' => $rejected,
                                            ])
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
