@extends('management.layout.main')

@section('title', 'Quản lý hợp tác')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ route('university.home') }}">{{ __('label.breadcrumb.home') }}</a></li>
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
                                        class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.university.collaboration.filter') }}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                                </div>
                            </div>

                            <div class="cm-content-body form excerpt">
                                <form method="GET" action="{{ route('university.collaboration') }}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-5 col-sm-6 mb-3">
                                                <label
                                                    class="form-label">{{ __('label.university.collaboration.search_fields') }}</label>
                                                <input type="text" class="form-control" name="search"
                                                       value="{{ request()->search }}"
                                                       placeholder="{{ __('label.university.collaboration.search_placeholder') }}">
                                            </div>
                                            <div class="col-xl-3 col-sm-6 mb-3">
                                                <label
                                                    class="form-label">{{ __('label.company.collaboration.date') }}</label>
                                                <input class="form-control input-daterange-datepicker" type="text"
                                                       name="date_range"  value="{{ old('date_range', request()->date_range ?? '') }}"
                                                       placeholder="{{ __('label.company.collaboration.fill_date_placeholder') }}">
                                            </div>
                                            <div class="col-xl-4 col-sm-6 align-self-end mb-3">
                                                <button class="btn btn-primary me-2" title="Click here to Search"
                                                        type="submit">
                                                    <i
                                                        class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.university.collaboration.filter') }}
                                                </button>
                                                <button class="btn btn-danger light" title="Click here to remove filter"
                                                        type="button"
                                                        onclick="window.location.href='{{ route('university.collaboration') }}'">
                                                    {{ __('label.university.collaboration.reset') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- kết quả tìm kếm --}}
                @if (isset($isSearchResult) && $isSearchResult)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('label.university.collaboration.search_result') }}</h4>
                        </div>
                        <div class="card-body">
                            @include('management.pages.university.collaboration.table', [
                                'data' => $data,
                                'status' => 'Search Results',
                            ])
                        </div>
                    </div>
                @endif

                {{-- Tab --}}
                <div class="custom-tab-1 " id="collaboration-container"
                     data-active-tab="{{ $isSearchResult ?? false ? 'search' : 'accept' }}"
                     style="{{ $isSearchResult ?? false ? 'display:none;' : '' }}">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'receive' ? 'active' : '' }}" data-bs-toggle="tab"
                               href="#receive" id="tab-receive">
                                <i class="la la-inbox mx-2"></i>{{ __('label.university.collaboration.received_request') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'request' ? 'active' : '' }}" data-bs-toggle="tab"
                               href="#request" id="tab-request">
                                <i class="la la-paper-plane mx-2"></i>{{ __('label.university.collaboration.request') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'accept' ? 'active' : '' }}" data-bs-toggle="tab"
                               href="#accept" id="tab-accept">
                                <i class="la la-check-circle mx-2"></i>{{ __('label.university.collaboration.accept') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'complete' ? 'active' : '' }}" data-bs-toggle="tab"
                               href="#complete" id="tab-complete">
                                <i class="la la-trophy mx-2"></i>{{ __('label.university.collaboration.complete') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'reject' ? 'active' : '' }}" data-bs-toggle="tab"
                               href="#reject" id="tab-reject">
                                <i class="la la-times-circle mx-2"></i>{{ __('label.university.collaboration.reject') }}</a>
                        </li>
                    </ul>

                    {{--                   Table content --}}
                    <div class="tab-content">
                        <div class="tab-pane fade {{ $activeTab == 'receive' ? 'show active' : '' }}" id="receive">
                            <div id="receive-content">
                                @include('management.pages.university.collaboration.table', [
                                    'data' => $receivedRequests,
                                    'status' => 'Receive',
                                ])
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'request' ? 'show active' : '' }}" id="request">
                            <div id="request-content">
                                @include('management.pages.university.collaboration.table', [
                                    'data' => $pendingRequests,
                                    'status' => 'Request',
                                ])
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'accept' ? 'show active' : '' }}" id="accept">
                            <div id="accept-content">
                                @include('management.pages.university.collaboration.table', [
                                    'data' => $accepted,
                                    'status' => 'Accept',
                                ])
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'complete' ? 'show active' : '' }}" id="complete">
                            <div id="complete-content">
                                @include('management.pages.university.collaboration.table', [
                                    'data' => $completed,
                                    'status' => 'Complete',
                                ])
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'reject' ? 'show active' : '' }}" id="reject">
                            <div id="reject-content">
                                @include('management.pages.university.collaboration.table', [
                                    'data' => $rejected,
                                    'status' => 'Reject',
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" > <!-- Đặt chiều rộng tối đa là 80% -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">{{ __('label.university.collaboration.detail_colab') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsModalBody">
                    <!-- Form bên trong modal -->
                    <form action="{{ route('university.changeStatusColab') }}" id="jobForm" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12 col-xl-3">
                                <div class="card box-2 pt-0" style="max-height: 240px;">
                                    <div class="flow">
                                        <div class="dz-media"><img
                                                src="{{ asset('management-assets/images/no-img-avatar.png') }}"
                                                class="avatar" id="avt_company" alt="">
                                            <h5 id="company-name">sssss</h5>
                                            <p id="company-size">{{ __('label.university.collaboration.size') }}: ssss</p>
                                        </div>
                                        <div class="side" style="background-color: #23c0e9;"></div>
                                    </div>
                                </div>
                                <div class="card box-2 pt-0" style="max-height: 240px;" id="feedback-div">
                                    <div class="flow">
                                        <div class="dz-media">
                                            <h5>{{ __('label.university.collaboration.feedback') }}</h5>
                                            <p id="res_message"> </p>
                                        </div>
                                        <div class="side" style="background-color: #dd260d;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-9">
                                <div class="card box-1 overflow-hidden">

                                    <div class="max-2 mt-3">
                                        <h2 class=" mb-3" id="title-colab">aaaaaaa</h2>

                                        <div class="ul-li">
                                            <ul class="d-flex mb-2">
                                                <li class="me-3 me-lg-5"><svg class="me-2" width="24"
                                                                              height="24" viewBox="0 0 24 24" fill="none"
                                                                              xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 14C12.1978 14 12.3911 13.9414 12.5556 13.8315C12.72 13.7216 12.8482 13.5654 12.9239 13.3827C12.9996 13.2 13.0194 12.9989 12.9808 12.8049C12.9422 12.6109 12.847 12.4327 12.7071 12.2929C12.5673 12.153 12.3891 12.0578 12.1951 12.0192C12.0011 11.9806 11.8 12.0004 11.6173 12.0761C11.4346 12.1518 11.2784 12.28 11.1685 12.4444C11.0587 12.6089 11 12.8022 11 13C11 13.2652 11.1054 13.5196 11.2929 13.7071C11.4804 13.8946 11.7348 14 12 14ZM17 14C17.1978 14 17.3911 13.9414 17.5556 13.8315C17.72 13.7216 17.8482 13.5654 17.9239 13.3827C17.9996 13.2 18.0194 12.9989 17.9808 12.8049C17.9422 12.6109 17.847 12.4327 17.7071 12.2929C17.5673 12.153 17.3891 12.0578 17.1951 12.0192C17.0011 11.9806 16.8 12.0004 16.6173 12.0761C16.4346 12.1518 16.2784 12.28 16.1685 12.4444C16.0587 12.6089 16 12.8022 16 13C16 13.2652 16.1054 13.5196 16.2929 13.7071C16.4804 13.8946 16.7348 14 17 14ZM12 18C12.1978 18 12.3911 17.9414 12.5556 17.8315C12.72 17.7216 12.8482 17.5654 12.9239 17.3827C12.9996 17.2 13.0194 16.9989 12.9808 16.8049C12.9422 16.6109 12.847 16.4327 12.7071 16.2929C12.5673 16.153 12.3891 16.0578 12.1951 16.0192C12.0011 15.9806 11.8 16.0004 11.6173 16.0761C11.4346 16.1518 11.2784 16.28 11.1685 16.4444C11.0587 16.6089 11 16.8022 11 17C11 17.2652 11.1054 17.5196 11.2929 17.7071C11.4804 17.8946 11.7348 18 12 18ZM17 18C17.1978 18 17.3911 17.9414 17.5556 17.8315C17.72 17.7216 17.8482 17.5654 17.9239 17.3827C17.9996 17.2 18.0194 16.9989 17.9808 16.8049C17.9422 16.6109 17.847 16.4327 17.7071 16.2929C17.5673 16.153 17.3891 16.0578 17.1951 16.0192C17.0011 15.9806 16.8 16.0004 16.6173 16.0761C16.4346 16.1518 16.2784 16.28 16.1685 16.4444C16.0587 16.6089 16 16.8022 16 17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18ZM7 14C7.19778 14 7.39112 13.9414 7.55557 13.8315C7.72002 13.7216 7.84819 13.5654 7.92388 13.3827C7.99957 13.2 8.01937 12.9989 7.98079 12.8049C7.9422 12.6109 7.84696 12.4327 7.70711 12.2929C7.56725 12.153 7.38907 12.0578 7.19509 12.0192C7.00111 11.9806 6.80004 12.0004 6.61732 12.0761C6.43459 12.1518 6.27841 12.28 6.16853 12.4444C6.05865 12.6089 6 12.8022 6 13C6 13.2652 6.10536 13.5196 6.29289 13.7071C6.48043 13.8946 6.73478 14 7 14ZM19 4H18V3C18 2.73478 17.8946 2.48043 17.7071 2.29289C17.5196 2.10536 17.2652 2 17 2C16.7348 2 16.4804 2.10536 16.2929 2.29289C16.1054 2.48043 16 2.73478 16 3V4H8V3C8 2.73478 7.89464 2.48043 7.70711 2.29289C7.51957 2.10536 7.26522 2 7 2C6.73478 2 6.48043 2.10536 6.29289 2.29289C6.10536 2.48043 6 2.73478 6 3V4H5C4.20435 4 3.44129 4.31607 2.87868 4.87868C2.31607 5.44129 2 6.20435 2 7V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H19C19.7957 22 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7957 22 19V7C22 6.20435 21.6839 5.44129 21.1213 4.87868C20.5587 4.31607 19.7957 4 19 4ZM20 19C20 19.2652 19.8946 19.5196 19.7071 19.7071C19.5196 19.8946 19.2652 20 19 20H5C4.73478 20 4.48043 19.8946 4.29289 19.7071C4.10536 19.5196 4 19.2652 4 19V10H20V19ZM20 8H4V7C4 6.73478 4.10536 6.48043 4.29289 6.29289C4.48043 6.10536 4.73478 6 5 6H19C19.2652 6 19.5196 6.10536 19.7071 6.29289C19.8946 6.48043 20 6.73478 20 7V8ZM7 18C7.19778 18 7.39112 17.9414 7.55557 17.8315C7.72002 17.7216 7.84819 17.5654 7.92388 17.3827C7.99957 17.2 8.01937 16.9989 7.98079 16.8049C7.9422 16.6109 7.84696 16.4327 7.70711 16.2929C7.56725 16.153 7.38907 16.0578 7.19509 16.0192C7.00111 15.9806 6.80004 16.0004 6.61732 16.0761C6.43459 16.1518 6.27841 16.28 6.16853 16.4444C6.05865 16.6089 6 16.8022 6 17C6 17.2652 6.10536 17.5196 6.29289 17.7071C6.48043 17.8946 6.73478 18 7 18Z"
                                                            fill="#FFD125" />
                                                    </svg>
                                                    <b id="created_at">aaaaaaa</b>
                                                </li>
                                                <li class="me-3 me-lg-5">
                                                    <svg class="me-2" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 6C11.8687 5.99997 11.7386 6.02581 11.6173 6.07605C11.4959 6.12629 11.3857 6.19995 11.2928 6.29282C11.2 6.38568 11.1263 6.49594 11.0761 6.61728C11.0258 6.73862 11 6.86867 11 7V11.3838L8.56934 12.6069C8.45206 12.6659 8.34755 12.7474 8.26178 12.8468C8.176 12.9462 8.11064 13.0615 8.06942 13.1861C8.0282 13.3108 8.01194 13.4423 8.02156 13.5733C8.03118 13.7042 8.0665 13.8319 8.12549 13.9492C8.18448 14.0665 8.26599 14.171 8.36538 14.2568C8.46476 14.3426 8.58006 14.4079 8.70471 14.4491C8.82935 14.4904 8.96089 14.5066 9.09182 14.497C9.22274 14.4874 9.35049 14.4521 9.46777 14.3931L12.4492 12.8931C12.6148 12.81 12.7541 12.6824 12.8513 12.5247C12.9486 12.367 13.0001 12.1853 13 12V7C13 6.86867 12.9742 6.73862 12.924 6.61728C12.8737 6.49594 12.8001 6.38568 12.7072 6.29282C12.6143 6.19995 12.5041 6.12629 12.3827 6.07605C12.2614 6.02581 12.1313 5.99997 12 6ZM12 2C10.0222 2 8.08879 2.58649 6.4443 3.6853C4.79981 4.78412 3.51809 6.3459 2.76121 8.17317C2.00433 10.0004 1.8063 12.0111 2.19215 13.9509C2.578 15.8907 3.53041 17.6725 4.92894 19.0711C6.32746 20.4696 8.10929 21.422 10.0491 21.8079C11.9889 22.1937 13.9996 21.9957 15.8268 21.2388C17.6541 20.4819 19.2159 19.2002 20.3147 17.5557C21.4135 15.9112 22 13.9778 22 12C21.997 9.34877 20.9424 6.80699 19.0677 4.93228C17.193 3.05758 14.6512 2.00303 12 2ZM12 20C10.4178 20 8.87104 19.5308 7.55544 18.6518C6.23985 17.7727 5.21447 16.5233 4.60897 15.0615C4.00347 13.5997 3.84504 11.9911 4.15372 10.4393C4.4624 8.88743 5.22433 7.46197 6.34315 6.34315C7.46197 5.22433 8.88743 4.4624 10.4393 4.15372C11.9911 3.84504 13.5997 4.00346 15.0615 4.60896C16.5233 5.21447 17.7727 6.23985 18.6518 7.55544C19.5308 8.87103 20 10.4178 20 12C19.9976 14.121 19.1539 16.1544 17.6542 17.6542C16.1544 19.1539 14.121 19.9976 12 20Z"
                                                            fill="#01A3FF" />
                                                    </svg>
                                                    <b id="end_date">aaaaaaa</b>
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="card-title mb-3">
                                            {{ __('label.university.collaboration.detail_colab') }}</h3>
                                        <div class="mt-4 job-detail" id="colab-content">

                                            aaaaaaaa
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <input type="hidden" name="id" value="aaaa">
                        <input type="hidden" name="status" value="">
                    </form>
                </div>
                <div class="modal-footer" id="buttonSubmit">
                    <button type="button" class="btn btn-danger light" onclick="openModal()" data-status='3'
                            id="btnReject">{{ __('label.university.collaboration.reject') }}</button>
                    <button type="button" class="btn btn-primary " onclick="submitForm(2)"
                            id="btnSubmit">{{ __('label.university.collaboration.approve') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal con -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">{{ __('label.university.collaboration.feedback') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rejectForm" action="{{ route('university.changeStatusColab') }}" method="POST">
                        @csrf
                        <input type="hidden" id="id-res" name="id" value="a">
                        <input type="hidden" name="status" value="3">
                        <div class="mb-3">
                            <label for="feedbackContent"
                                   class="form-label">{{ __('label.university.collaboration.feedback_content') }}</label>
                            <textarea class="form-control" id="feedbackContent"
                                      placeholder="{{ __('label.university.collaboration.feedback_placeholder') }}" name="res_message"
                                      rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('label.university.collaboration.cancel') }}</button>
                    <button type="button" class="btn btn-primary"
                            id="sendFeedback">{{ __('label.university.collaboration.send') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/clockpicker/css/bootstrap-clockpicker.min.css">
    <link rel="stylesheet"
          href="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/pickadate/themes/default.date.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        .card{
            height: auto !important; 
        }
        .col-md-12.col-xl-3 {
            margin-bottom: 60px;
            /* Adjust the value as needed */
        }

        #res_message {
            max-height: 160px;
            overflow-y: auto;
        }

        .job-detail {
            font-family: 'poppins', sans-serif !important;
            max-height: 400px;
            overflow-y: scroll;
        }

        .job-detail h1 {
            font-size: 1.6rem
        }

        .job-detail h2 {
            font-size: 1.4rem
        }

        .job-detail h3 {
            font-size: 1.2rem
        }

        .job-detail h4 {
            font-size: 1rem
        }

        .job-detail h5 {
            font-size: 0.8rem
        }

        .job-detail h6 {
            font-size: 0.7rem
        }
    </style>
    <style>
        .modal-blur {
            filter: blur(5px);
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('management-assets/vendor/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('management-assets') }}/vendor/moment/moment.min.js"></script>
    <script src="{{ asset('management-assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script
        src="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>
    <script src="{{ asset('management-assets') }}/js/plugins-init/bs-daterange-picker-init.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                const paginationLink = e.target.closest('.pagination a');
                if (paginationLink) {
                    e.preventDefault();

                    // Lấy URL phân trang
                    const url = paginationLink.href;

                    // Lấy tab hiện tại
                    const activeTab = document.querySelector('.nav-tabs .nav-link.active').getAttribute(
                        'href').replace('#', '');

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById(`${activeTab}-content`).innerHTML = html;

                            // Cập nhật lại trạng thái active cho tab
                            const activeLink = document.querySelector(
                                `.nav-tabs .nav-link[href="#${activeTab}"]`);
                            if (activeLink) {
                                activeLink.classList.add('active');
                            }
                            window.scrollTo(0, 0);
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

            // Xử lý khi chuyển tab
            const tabs = document.querySelectorAll('.nav-tabs .nav-link');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Lấy tab được chọn
                    const tabId = this.getAttribute('href').replace('#', '');

                    // Gửi AJAX request để lấy dữ liệu của tab
                    const url = `{{ route('university.collaboration') }}?active_tab=${tabId}`;

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            // Cập nhật lại nội dung cho tab
                            document.getElementById(`${tabId}-content`).innerHTML = html;

                            // Cập nhật lại trạng thái active cho tab
                            tabs.forEach(t => t.classList.remove('active'));
                            this.classList.add('active');
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '.pagination a', function(e) {
            // Kiểm tra nếu sự kiện không bị ngăn chặn
            e.preventDefault(); // Nếu có, bỏ qua lệnh này

            var url = $(this).attr('href');
            window.location.href = url; // Dẫn hướng đến URL mới của phân trang
        });
    </script>

    <script>
        document.getElementById('btnReject').addEventListener('click', function(e) {
            const rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            document.querySelector('.modal.show').classList.add('modal-blur');
            rejectModal.show();
        });

        document.getElementById('rejectModal').addEventListener('hidden.bs.modal', function() {
            document.querySelector('.modal.show').classList.remove('modal-blur');
        });

        document.getElementById('sendFeedback').addEventListener('click', function(e) {
            document.getElementById('rejectForm').submit();
        });

        function getDetailColab(data) {
            document.getElementById('title-colab').innerText = data.title;
            document.getElementById('created_at').innerText = '{{ __('label.university.collaboration.created_at') }}: ' +
                formatDate(data.created_at);
            document.getElementById('end_date').innerText = '{{ __('label.university.collaboration.end_date') }}: ' +
                formatDate(data.end_date);
            document.getElementById('colab-content').innerHTML = data.content;
            document.getElementById('company-name').innerText = '{{ __('label.university.collaboration.company') }}: ' +
                data.company.name;
            document.getElementById('company-size').innerText = '{{ __('label.university.collaboration.size') }}: ' + data
                .company.size;
            document.getElementById('avt_company').src = data.company.avatar_path ? window.location.origin + '/' +  data.company.avatar_path :
                '{{ asset('management-assets/images/no-img-avatar.png') }}';
            document.querySelector('#jobForm input[name="id"]').value = data.id;
            document.getElementById('id-res').value = data.id;

            if (data.status == {{ STATUS_PENDING }} && data.created_by != {{ auth('admin')->user()->role }}) {
                document.getElementById('btnSubmit').style.display = '';
                document.getElementById('btnReject').style.display = '';
                document.getElementById('buttonSubmit').style.display = '';
            } else {
                document.getElementById('btnSubmit').style.display = 'none';
                document.getElementById('btnReject').style.display = 'none';
                document.getElementById('buttonSubmit').style.display = 'none';
            }

            if (data.status == {{ STATUS_REJECTED }}) {
                document.getElementById('feedback-div').style.display = '';
                document.getElementById('res_message').innerText = data.response_message;
            } else {
                document.getElementById('feedback-div').style.display = 'none';
            }

            $('#detailsModal').modal('show');
        }

        function submitForm(vl) {
            let form = document.getElementById('jobForm');
            document.querySelector('#jobForm input[name="status"]').value = vl;
            form.submit(); // Gửi form
        }

        function formatDate(dateString) {
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            let form = $(this).closest('.delete-form');
            Swal.fire({
                title: "{{ __('label.university.collaboration.revoke_confirm') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "{{ __('label.university.collaboration.revoke') }}",
                cancelButtonText: "{{ __('label.university.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

@endsection
