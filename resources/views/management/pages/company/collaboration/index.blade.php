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
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ __('label.breadcrumb.collaboration') }}</li>
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
                                    <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.company.collaboration.filter') }}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                                </div>
                            </div>

                            <div class="cm-content-body form excerpt">
                                <form method="GET" action="{{ route('company.collaboration') }}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-5 col-sm-6 mb-3">
                                                <label class="form-label">{{ __('label.company.collaboration.search_fields') }}</label>
                                                <input type="text" class="form-control" name="search"
                                                       value="{{ request()->search }}"
                                                       placeholder="{{ __('label.company.collaboration.search_placeholder') }}">
                                            </div>

{{--                                            <div class="col-xl-3 col-sm-6 mb-3">--}}
{{--                                                <label class="form-label">{{ __('label.company.collaboration.date') }}</label>--}}
{{--                                                <input class="form-control input-daterange-datepicker" type="text"--}}
{{--                                                       name="date_range" value="{{ request()->date_range ?? '' }}"--}}
{{--                                                       placeholder="Nhấn để chọn khoản thời gian">--}}
{{--                                            </div>--}}

                                            <div class="col-xl-4 col-sm-6 align-self-end mb-3">
                                                <button class="btn btn-primary me-2" title="Click here to Search"
                                                        type="submit">
                                                    <i class="fa-sharp fa-solid fa-filter me-2"></i>{{ __('label.company.collaboration.filter') }}
                                                </button>
                                                <button class="btn btn-danger light" title="Click here to remove filter"
                                                        type="button"
                                                        onclick="window.location.href='{{ route('company.collaboration') }}'">
                                                    {{ __('label.company.collaboration.reset') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{--kết quả tìm kếm--}}
                @if(isset($isSearchResult) && $isSearchResult)
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('label.company.collaboration.search_result') }}</h4>
                        </div>
                        <div class="card-body">
                            @include('management.pages.company.collaboration.table', ['data' => $data, 'status' => 'Search Results'])
                        </div>
                    </div>
                @endif

                {{--Tab--}}
                <div class="custom-tab-1 " id="collaboration-container"
                     data-active-tab="{{ $isSearchResult ?? false ? 'search' : 'accept' }}"
                     style="{{ $isSearchResult ?? false ? 'display:none;' : '' }}">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'accept' ? 'active' : '' }}"
                               data-bs-toggle="tab" href="#accept" id="tab-accept">
                                <i class="la la-check-circle mx-2"></i>{{ __('label.company.collaboration.accept') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'request' ? 'active' : '' }}"
                               data-bs-toggle="tab" href="#request" id="tab-request">
                                <i class="la la-code-branch mx-2"></i>{{ __('label.company.collaboration.request') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab == 'reject' ? 'active' : '' }}"
                               data-bs-toggle="tab" href="#reject" id="tab-reject">
                                <i class="la la-times-circle mx-2"></i>{{ __('label.company.collaboration.reject') }}</a>
                        </li>
                    </ul>

                    {{--                   Table content--}}
                    <div class="tab-content">
                        <div class="tab-pane fade {{ $activeTab == 'accept' ? 'show active' : '' }}" id="accept">
                            <div id="accept-content">
                                @include('management.pages.company.collaboration.table', ['data' => $accepted, 'status' => 'Accepted'])
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'request' ? 'show active' : '' }}" id="request">
                            <div id="request-content">
                                @include('management.pages.company.collaboration.table', ['data' => $pendingRequests, 'status' => 'Pending'])
                            </div>
                        </div>
                        <div class="tab-pane fade {{ $activeTab == 'reject' ? 'show active' : '' }}" id="reject">
                            <div id="reject-content">
                                @include('management.pages.company.collaboration.table', ['data' => $rejected, 'status' => 'Rejected'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="modal fade" id="exampleModalCenter">
            <div class="modal-xl modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light"
                                data-bs-dismiss="modal">{{ __('label.company.collaboration.close') }}
                        </button>
                        {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/clockpicker/css/bootstrap-clockpicker.min.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('management-assets') }}/vendor/pickadate/themes/default.date.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection

@section('js')
    <script src="{{ asset('management-assets/vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('management-assets') }}/vendor/moment/moment.min.js"></script>
    <script src="{{ asset('management-assets') }}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script
        src="{{ asset('management-assets') }}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>
    <script src="{{ asset('management-assets') }}/js/plugins-init/bs-daterange-picker-init.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (e) {
                const paginationLink = e.target.closest('.pagination a');
                if (paginationLink) {
                    e.preventDefault();

                    // Lấy URL phân trang
                    const url = paginationLink.href;

                    // Lấy tab hiện tại
                    const activeTab = document.querySelector('.nav-tabs .nav-link.active').getAttribute('href').replace('#', '');

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById(`${activeTab}-content`).innerHTML = html;

                            // Cập nhật lại trạng thái active cho tab
                            const activeLink = document.querySelector(`.nav-tabs .nav-link[href="#${activeTab}"]`);
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
                tab.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Lấy tab được chọn
                    const tabId = this.getAttribute('href').replace('#', '');

                    // Gửi AJAX request để lấy dữ liệu của tab
                    const url = `{{ route('company.collaboration') }}?active_tab=${tabId}`;

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
        e.preventDefault();  // Nếu có, bỏ qua lệnh này

        var url = $(this).attr('href');
        window.location.href = url;  // Dẫn hướng đến URL mới của phân trang
    });

</script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('exampleModalCenter'));

            // Sử dụng event delegation
            document.addEventListener('click', function (event) {
                if (event.target.closest('.modalTrigger')) {
                    const triggerButton = event.target.closest('.modalTrigger');

                    // Lấy dữ liệu từ các attributes
                    const id = triggerButton.getAttribute('data-id');
                    const title = triggerButton.getAttribute('data-title');
                    const message = triggerButton.getAttribute('data-message');
                    const university = triggerButton.getAttribute('data-university');
                    const content = triggerButton.getAttribute('data-content');

                    // Cập nhật nội dung modal
                    modal._element.querySelector('.modal-title').textContent = `Chi tiết hợp tác: ${title}`;
                    modal._element.querySelector('.modal-body').innerHTML = `
                <p><strong>{{ __('label.company.collaboration.university') }}:</strong> ${university}</p>
                <p><strong>{{ __('label.company.collaboration.content') }}:</strong> ${content}</p>
            `;
                    // Mở modal
                    modal.show();
                }
            });
        });
    </script>
@endsection
