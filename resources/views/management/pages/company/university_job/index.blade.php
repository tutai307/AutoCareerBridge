@extends('management.layout.main')

@section('title', 'Quản lý hợp tác')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('company.home') }}">{{ __('label.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('label.breadcrumb.collaboration') }}</li>
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
                                <div class="cpa">
                                    <i
                                        class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.company.collaboration.filter') }}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                                </div>
                            </div>



                            <div class="custom-tab-1" id="collaboration-container">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#pending" id="tab-accept">
                                            <i class="la la-check-circle mx-2"></i>Chờ duyệt
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#approved" id="tab-approved">
                                            <i class="la la-code-branch mx-2"></i>Đã duyệt
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#rejected" id="tab-rejected">
                                            <i class="la la-code-branch mx-2"></i>Từ chối
                                        </a>
                                    </li>
                                </ul>

                                <!-- Nội dung của các tab -->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="pending">
                                        <div id="pending-content">
                                            @include('management.pages.company.university_job.table', [
                                                'data' => $pending,
                                            ])
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="approved">
                                        <div id="approved-content">
                                            @include('management.pages.company.university_job.table', [
                                                'data' => $approved,
                                            ])
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="rejected">
                                        <div id="rejected-content">
                                            @include('management.pages.company.university_job.table', [
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
