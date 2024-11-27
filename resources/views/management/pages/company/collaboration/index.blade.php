@extends('management.layout.main')

@section('title', 'Quản lý hợp tác')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ __('label.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ __('label.breadcrumb.collaboration') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('label.breadcrumb.collaboration') }}</h4>
                    <div class="input-group search-area">
                        <span class="input-group-text"><a href="javascript:void(0)">
                                <svg width="15" height="15" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z"
                                        fill="#01A3FF"/>
                                </svg>
                            </a></span>
                        <input type="text" class="form-control" placeholder="Search here...">
                    </div>
                </div>
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#active" id="tab-active">
                                <i class="la la-play-circle mx-2"></i>Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#request" id="tab-request">
                                <i class="la la-code-branch mx-2"></i>Pending Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#accept" id="tab-accept"><i
                                    class="la la-check-circle mx-2"></i>Accepted</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#reject" id="tab-reject">
                                <i class="la la-times-circle mx-2"></i>Rejected</a>
                        </li>
                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="active">
                            @include('management.pages.company.collaboration.table', ['data' => $activeShips, 'status' => 'Active'])
                        </div>
                        <div class="tab-pane fade" id="request">
                            @include('management.pages.company.collaboration.table', ['data' => $pendingRequests, 'status' => 'Pending'])
                        </div>
                        <div class="tab-pane fade" id="accept">
                            @include('management.pages.company.collaboration.table', ['data' => $acceptedShips, 'status' => 'Accepted'])
                        </div>
                        <div class="tab-pane fade" id="reject">
                            @include('management.pages.company.collaboration.table', ['data' => $rejectedShips, 'status' => 'Rejected'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

        $(document).ready(function() {
            const tab = localStorage.getItem('activeTab');
            if (tab) {
                $('#tabs a[href="' + tab + '"]').tab('show');
            }

            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
        });
        $(document).ready(function () {
            // Kiểm tra xem tab hiện tại có được lưu trong localStorage không
            var activeTab = localStorage.getItem('activeTab');

            // Nếu có, kích hoạt tab đó
            if (activeTab) {
                $('#' + activeTab).tab('show');
            }

            // Lắng nghe sự kiện khi người dùng thay đổi tab
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                // Lưu lại tab hiện tại vào localStorage
                var activeTabId = $(e.target).attr('id'); // Lấy ID của tab đang được chọn
                localStorage.setItem('activeTab', activeTabId);
            });
        });

    </script>
    <script src="{{ asset('management-assets/vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('management-assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('management-assets/js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="{{ asset('management-assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>


@endsection
