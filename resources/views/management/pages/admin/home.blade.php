@extends('management.layout.main')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('management-assets/css/admins/home.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('admin.home') }}">{{ __('label.admin.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ __('label.admin.dashboard.title') }}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>


            <div
                class="swiper mySwiper-counter position-relative overflow-hidden swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden">
                <div class="swiper-wrapper">
                    <!--swiper-slide-->
                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-people" style="font-size: 22px;"></i> <!-- Bootstrap Icon -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{ $totalUserComJobUni['users'] }}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_user') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-buildings" style="font-size: 22px;"></i>
                                    <!-- Bootstrap Icon cho Doanh nghiệp -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{ $totalUserComJobUni['companies'] }}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_company') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-briefcase" style="font-size: 22px;"></i>
                                    <!-- Bootstrap Icon cho Job -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="font-w600 mb-0">{{ $totalUserComJobUni['jobs'] }}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_job') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-building" style="font-size: 22px;"></i>
                                    <!-- Bootstrap Icon cho Trường đại học -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{ $totalUserComJobUni['universities'] }}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_university') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>

            <div class="row">
                <div class="col-xl-9 wow fadeInUp" data-wow-delay="1.5s">
                    <div class="card crypto-chart ">
                        <div class="card-header pb-0 border-0 flex-wrap">
                            <div class="mb-2 mb-sm-0">
                                <div class="chart-title mb-3">
                                    <h2 class="card-title">{{ __('label.admin.dashboard.job_chart') }}</h2>
                                </div>
                                <div class="d-flex align-items-center mb-3 mb-sm-0">
                                    <div class="round " id="dzNewSeries">
                                        <div>
                                            <input type="checkbox" id="checkbox" checked name="radio" value="monthly">
                                            <label for="checkbox" class="checkmark"></label>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ __('label.admin.dashboard.job_posted') }}</p>
                                            <h6 class="mb-0" id="jobAproved">1.982</h6>
                                        </div>
                                    </div>
                                    <div class="round weekly" id="dzOldSeries">
                                        <div>
                                            <input type="checkbox" checked id="checkbox1" name="radio" value="weekly">
                                            <label for="checkbox1" class="checkmark"></label>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ __('label.admin.dashboard.job_deleted') }}</p>
                                            <h6 class="mb-0" id="jobDeleted">1.982</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-static">
                                <div class="d-flex align-items-center mb-3 ">
                                    <select class="bootstrap-select image-select default-select dashboard-select d-block"
                                        id="changeDate" aria-label="Default">
                                        <option value="365">{{ __('label.admin.dashboard.365_days') }}</option>
                                        <option value="180">{{ __('label.admin.dashboard.180_days') }}</option>
                                        <option value="90">{{ __('label.admin.dashboard.90_days') }}</option>
                                        <option value="28" selected>{{ __('label.admin.dashboard.30_days') }}</option>
                                        <option value="7">{{ __('label.admin.dashboard.7_days') }}</option>
                                        <option value="1">{{ __('label.admin.dashboard.today') }}</option>
                                    </select>

                                    <select class="bootstrap-select image-select default-select dashboard-select d-block"
                                        id="changeQuarter" aria-label="Default">
                                        <option value="1" selected>{{ __('label.admin.dashboard.spring') }}</option>
                                        <option value="2">{{ __('label.admin.dashboard.summer') }}</option>
                                        <option value="3">{{ __('label.admin.dashboard.autumn') }}</option>
                                        <option value="4">{{ __('label.admin.dashboard.winter') }}</option>
                                    </select>

                                    <div class="d-flex align-items-center" id="changeSpace">
                                        <input type="text" id="start_date" autocomplete="off"
                                            class="form-control text-center bt-datepicker bootstrap-select image-select default-select dashboard-select"
                                            placeholder="Từ ngày">
                                        <input type="text" id="end_date" autocomplete="off"
                                            class="form-control text-center bt-datepicker bootstrap-select image-select default-select dashboard-select"
                                            placeholder="Đến ngày">
                                    </div>

                                    <div class="dropdown custom-dropdown">
                                        <div class="btn sharp btn-primary tp-btn" title="Filter" data-tool-tip="Filter"
                                            data-bs-toggle="dropdown">
                                            <svg width="5" height="15" viewBox="0 0 6 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.19995 10.001C5.19995 9.71197 5.14302 9.42576 5.03241 9.15872C4.9218 8.89169 4.75967 8.64905 4.55529 8.44467C4.35091 8.24029 4.10828 8.07816 3.84124 7.96755C3.5742 7.85694 3.28799 7.80001 2.99895 7.80001C2.70991 7.80001 2.4237 7.85694 2.15667 7.96755C1.88963 8.07816 1.64699 8.24029 1.44261 8.44467C1.23823 8.64905 1.0761 8.89169 0.965493 9.15872C0.854882 9.42576 0.797952 9.71197 0.797952 10.001C0.798085 10.5848 1.0301 11.1445 1.44296 11.5572C1.85582 11.9699 2.41571 12.2016 2.99945 12.2015C3.58319 12.2014 4.14297 11.9694 4.55565 11.5565C4.96832 11.1436 5.20008 10.5838 5.19995 10L5.19995 10.001ZM5.19995 3.00101C5.19995 2.71197 5.14302 2.42576 5.03241 2.15872C4.9218 1.89169 4.75967 1.64905 4.55529 1.44467C4.35091 1.24029 4.10828 1.07816 3.84124 0.967552C3.5742 0.856941 3.28799 0.800011 2.99895 0.800011C2.70991 0.800011 2.4237 0.856941 2.15667 0.967552C1.88963 1.07816 1.64699 1.24029 1.44261 1.44467C1.23823 1.64905 1.0761 1.89169 0.965493 2.15872C0.854883 2.42576 0.797953 2.71197 0.797953 3.00101C0.798085 3.58475 1.0301 4.14453 1.44296 4.55721C1.85582 4.96988 2.41571 5.20164 2.99945 5.20151C3.58319 5.20138 4.14297 4.96936 4.55565 4.5565C4.96832 4.14364 5.20008 3.58375 5.19995 3.00001L5.19995 3.00101ZM5.19995 17.001C5.19995 16.712 5.14302 16.4258 5.03241 16.1587C4.9218 15.8917 4.75967 15.6491 4.55529 15.4447C4.35091 15.2403 4.10828 15.0782 3.84124 14.9676C3.5742 14.8569 3.28799 14.8 2.99895 14.8C2.70991 14.8 2.4237 14.8569 2.15666 14.9676C1.88963 15.0782 1.64699 15.2403 1.44261 15.4447C1.23823 15.6491 1.0761 15.8917 0.965493 16.1587C0.854882 16.4258 0.797952 16.712 0.797952 17.001C0.798084 17.5848 1.0301 18.1445 1.44296 18.5572C1.85582 18.9699 2.41571 19.2016 2.99945 19.2015C3.58319 19.2014 4.14297 18.9694 4.55565 18.5565C4.96832 18.1436 5.20008 17.5838 5.19995 17L5.19995 17.001Z"
                                                    fill="
                                            " />
                                            </svg>
                                        </div>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item changeTypeDashboard active" data-type="1"
                                                href="javascript:void(0);">{{ __('label.admin.dashboard.default') }}</a>
                                            <a class="dropdown-item changeTypeDashboard" data-type="2"
                                                href="javascript:void(0);">{{ __('label.admin.dashboard.quater') }}</a>
                                            <a class="dropdown-item changeTypeDashboard" data-type="3"
                                                href="javascript:void(0);">{{ __('label.admin.dashboard.select_date_range') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body pt-2 custome-tooltip pb-0">
                            <div id="activity"></div>
                        </div>
                    </div>
                </div>
                <!--column-->
                <div class="col-xl-3 wow fadeInUp" data-wow-delay="1s"
                    style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                    <div class="card">
                        <div class="card-header border-0">
                            <h2 class="card-title">{{ __('label.admin.dashboard.com_uni_statistics') }}</h2>

                        </div>
                        <div class="card-body text-center pt-0 pb-2">
                            <div id="pieChart" class="d-inline-block" style="min-height: 182.8px;">

                            </div>
                            <div class="chart-items">
                                <!--row-->
                                <div class="row">
                                    <!--column-->
                                    <div class=" col-xl-12 col-sm-12">
                                        <div class="text-start mt-2">
                                            <div class="color-picker">
                                                <p class="mb-0 text-gray">
                                                    <svg class="me-2" width="14" height="14"
                                                        viewBox="0 0 14 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4"
                                                            fill="#ff9800">
                                                        </rect>
                                                    </svg>
                                                    {{ __('label.admin.university') }}
                                                    ({{ number_format(($totalUserComJobUni['universities'] / ($totalUserComJobUni['universities'] + $totalUserComJobUni['companies'])) * 100, 1) }}%)
                                                </p>
                                                <h6 class="mb-0">{{ $totalUserComJobUni['universities'] }}</h6>
                                            </div>
                                            <div class="color-picker">
                                                <p class="mb-0  text-gray">
                                                    <svg class="me-2" width="14" height="14"
                                                        viewBox="0 0 14 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4"
                                                            fill="#9568FF">
                                                        </rect>
                                                    </svg>
                                                    {{ __('label.admin.company') }}
                                                    ({{ number_format(($totalUserComJobUni['companies'] / ($totalUserComJobUni['universities'] + $totalUserComJobUni['companies'])) * 100, 1) }}%)
                                                </p>
                                                <h6 class="mb-0">{{ $totalUserComJobUni['companies'] }}</h6>
                                            </div>

                                        </div>
                                    </div>
                                    <!--/column-->
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/column-->
            </div>

            <div class="row">
                <!--column-->
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="1.5s"
                    style="visibility: visible; animation-delay: 1.5s; animation-name: fadeInUp;">
                    <!--card-->
                    <div class="card statistic">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="card-header border-0 flex-wrap pb-2">
                                    <div class="chart-title mb-2 ">
                                        <h2 class="card-title text-white">
                                            {{ __('label.admin.dashboard.job_matching_statistics') }}({{ $currentYear }})
                                        </h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 custome-tooltip pe-0 pb-0">
                                    <div id="chartBarRunning"></div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="statistic-content">

                                    <div class="statistic-toggle my-3">
                                        <div class="toggle-btn" id="dzExpenseSeries">
                                            <div>
                                                <input type="checkbox" id="checkbox3" name="toggle-btn" value="Income">
                                                <label for="checkbox3" class="check"></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-white">
                                                    {{ __('label.admin.dashboard.job_matching_success') }}</p>
                                                <h6 class="mb-0 text-white" id="job-m-success">1.982</h6>
                                            </div>
                                        </div>
                                        <div class="toggle-btn expense" id="dzIncomeSeries">
                                            <div>
                                                <input type="checkbox" id="checkbox2" name="toggle-btn" value="Expense">
                                                <label for="checkbox2" class="check"></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-yellow">{{ __('label.admin.dashboard.job_vacant') }}
                                                </p>
                                                <h6 class="mb-0 text-yellow" id="job-vacant">1.982</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--card-->
                                    <div class="card expense mb-3">
                                        <div class="card-body p-3">
                                            <div class="students1 d-flex align-items-center justify-content-between ">
                                                <div class="content">
                                                    <p class="mb-0 text-white">
                                                        {{ __('label.admin.dashboard.job_matching_success') }}
                                                    </p>
                                                    <h3 class="text-white" id="job-m-success-big">12,890</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/card-->
                                    <!--card-->
                                    <div class="card expense mb-3 ">
                                        <div class="card-body p-3 ">
                                            <div class="students1 d-flex align-items-center justify-content-between ">
                                                <div class="content">
                                                    <p class="mb-0 text-yellow">
                                                        {{ __('label.admin.dashboard.job_vacant') }}
                                                    </p>
                                                    <h3 class="text-yellow" id="job-vacant-big">12,890</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/card-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/card-->
                </div>
                <!--column-->


            </div>


        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.vi.min.js">
    </script>

    <script>
        $(document).ready(function() {
            let token = $('meta[name="csrf-token"]').attr('content');
            let changeQuarter = $('#changeQuarter');
            let changeSpace = $('#changeSpace');
            let changeDay = $('#changeDate');
            let defaultDate = 30;
            let lang = $('meta[name="lang"]').attr('content');

            changeQuarter.parent('div').removeClass('d-block');
            changeSpace.addClass('d-none');

            let currentDate = new Date();
            let formattedCurrentDate = formatDateToISO(currentDate);

            // Tính toán ngày trước đó (subtract ngày từ currentDate)
            let previousDate = new Date(currentDate.getTime() - (defaultDate * 24 * 60 * 60 * 1000));
            let formattedPreviousDate = formatDateToISO(previousDate);
            changeDate(formattedPreviousDate, formattedCurrentDate);

            function formatDateToISO(dateObj) {
                let year = dateObj.getFullYear();
                let month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
                let day = dateObj.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            // Lắng nghe sự kiện thay đổi ngày
            $("#changeDate").change(function() {
                let dateOption = $(this).val();

                // Tính toán ngày trước đó (subtract ngày từ currentDate)
                let previousDateOption = new Date(currentDate.getTime() - (dateOption * 24 * 60 * 60 *
                    1000));
                let formattedPreviousDateOption = formatDateToISO(previousDateOption);

                if (formattedPreviousDateOption, formattedCurrentDate) {
                    changeDate(formattedPreviousDateOption, formattedCurrentDate);
                }
                if (dateOption == 1) {
                    let today = new Date();
                    let formattedToday = formatDateToISO(today);
                    changeDate(formattedToday, formattedToday);
                }
            });

            // Loại filter
            $(".changeTypeDashboard").on("click", function() {
                $(".changeTypeDashboard").removeClass("active");
                $(this).addClass("active");
                let type = $(this).data("type");

                if (type == 1) {
                    changeDay.parent('div').addClass('d-block');
                    changeQuarter.parent('div').removeClass('d-block');
                    changeSpace.addClass('d-none');
                    changeDate(formattedPreviousDate, formattedCurrentDate);

                } else if (type == 2) {
                    changeDay.parent('div').removeClass('d-block');
                    changeQuarter.parent('div').addClass('d-block');
                    changeSpace.addClass('d-none');

                    let quarter = 1;
                    let startMonth = (quarter - 1) * 3;
                    let endMonth = quarter * 3;
                    let startDate = new Date(currentDate.getFullYear(), startMonth, 1);
                    let formattedPreviousDateOption = formatDateToISO(startDate);
                    let endDate = new Date(currentDate.getFullYear(), endMonth, 0);
                    let formattedCurrentDate = formatDateToISO(endDate);
                    changeDate(formattedPreviousDateOption, formattedCurrentDate);

                    changeQuarter.on("change", function() {
                        let quarter = parseInt($(this).val(), 10);

                        if (quarter >= 1 && quarter <= 4) {
                            let startMonth = (quarter - 1) * 3;
                            let endMonth = quarter * 3;
                            let startDate = new Date(currentDate.getFullYear(), startMonth, 1);
                            let formattedPreviousDateOption = formatDateToISO(startDate);
                            let endDate = new Date(currentDate.getFullYear(), endMonth, 0);
                            let formattedCurrentDate = formatDateToISO(endDate);
                            changeDate(formattedPreviousDateOption, formattedCurrentDate);
                        } else {
                            console.error("Quarter value is invalid:", quarter);
                        }
                    });

                } else {
                    changeDay.parent('div').removeClass('d-block');
                    changeQuarter.parent('div').removeClass('d-block');
                    changeSpace.removeClass('d-none');


                    function formatDate(startDate, endDate) {
                        if (lang === "vi") {
                            return {
                                formattedStartDate: [startDate[2], startDate[1], startDate[0]].join('-'),
                                formattedEndDate: [endDate[2], endDate[1], endDate[0]].join('-'),
                            };
                        } else {
                            return {
                                formattedStartDate: [startDate[2], startDate[0], startDate[1]].join('-'),
                                formattedEndDate: [endDate[2], endDate[0], endDate[1]].join('-'),
                            };
                        }
                    }

                    function validateDates(startDate, endDate) {
                        if (startDate.length !== 3 || endDate.length !== 3 || !startDate.join('').trim() ||
                            !endDate.join('').trim()) {
                            toastr.error("", "Ngày bắt đầu và kết thúc không được để trống.", {
                                positionClass: "toast-top-right",
                                timeOut: 2000,
                                closeButton: true,
                                progressBar: true
                            });
                            return false;
                        }

                        let {
                            formattedStartDate,
                            formattedEndDate
                        } = formatDate(startDate, endDate);

                        if (new Date(formattedStartDate) > new Date(formattedEndDate)) {
                            toastr.error("", "Ngày bắt đầu không lớn hơn ngày kết thúc.", {
                                positionClass: "toast-top-right",
                                timeOut: 2000,
                                closeButton: true,
                                progressBar: true
                            });
                            return false;
                        }

                        return true;
                    }

                    $("#end_date").off("change").on("change", function() {
                        let startDate = $("#start_date").val().split('/');
                        let endDate = $(this).val().split('/');

                        if (validateDates(startDate, endDate)) {
                            let {
                                formattedStartDate,
                                formattedEndDate
                            } = formatDate(startDate, endDate);
                            changeDate(formattedStartDate, formattedEndDate);
                        }
                    });

                    $("#start_date").off("change").on("change", function() {
                        let startDate = $(this).val().split('/');
                        let endDate = $("#end_date").val().split('/');

                        if (validateDates(startDate, endDate)) {
                            let {
                                formattedStartDate,
                                formattedEndDate
                            } = formatDate(startDate, endDate);
                            changeDate(formattedStartDate, formattedEndDate);
                        }
                    });

                }
            })

            // Hàm gọi Ajax để thay đổi dữ liệu dựa trên ngày
            function changeDate(formattedPreviousDate, formattedCurrentDate) {
                $.ajax({
                    url: "{{ route('admin.getJobChart') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        previousDate: formattedPreviousDate,
                        currentDate: formattedCurrentDate,
                    },
                    success: function(response) {

                        let totalJobApperoved = response.jobApperoved.reduce((a, b) => a + b, 0);
                        let totalJobDelete = response.jobDelete.reduce((a, b) => a + b, 0);

                        // Cập nhật biểu đồ
                        updateChart(response.jobApperoved, response.jobDelete, response.date,
                            totalJobApperoved,
                            totalJobDelete);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }

            // Hàm cập nhật hoặc tạo biểu đồ
            function updateChart(jobApperoved, jobDelete, date, totalJobApperoved, totalJobDelete) {
                $("#jobAproved").text(totalJobApperoved);
                $("#jobDeleted").text(totalJobDelete);
                if (!date || date.length === 0) {
                    date = ["{{ __('label.university.dashboard.no_data') }}"];
                    jobPending = [0];
                    jobApperoved = [0];
                    jobReject = [0];
                }
                var optionsArea = {
                    series: [{
                            name: "{{ __('label.admin.dashboard.job_posted') }}",
                            color: '#2196F3', // Màu xanh dương sáng
                            data: jobApperoved
                        },
                        {
                            name: "{{ __('label.admin.dashboard.job_deleted') }}",
                            color: '#F44336', // Màu đỏ tươi
                            data: jobDelete
                        }
                    ],
                    chart: {
                        height: 300,
                        type: 'area',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: [4, 4],
                        curve: 'smooth', // Tạo đường cong mượt mà
                        colors: ['#2196F3', '#F44336'] // Màu viền riêng cho mỗi đường
                    },
                    xaxis: {
                        type: 'category', // Sử dụng `category` thay vì `datetime`
                        categories: date, // Dữ liệu được cập nhật
                        labels: {
                            style: {
                                colors: 'var(--text)',
                                fontSize: '14px',
                                fontFamily: 'Poppins',
                                fontWeight: 100
                            }
                        }
                    },

                    yaxis: {
                        labels: {
                            offsetX: -16,
                            style: {
                                colors: 'var(--text)',
                                fontSize: '14px',
                                fontFamily: 'Poppins',
                                fontWeight: 100
                            }
                        }
                    },
                    markers: {
                        size: [8, 8],
                        strokeWidth: [4, 4],
                        strokeColors: ['#2196F3', '#F44336'], // Màu viền của markers
                        colors: ['#fff', '#fff'],
                        hover: {
                            size: 10
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            colorStops: [
                                [{
                                    offset: 0,
                                    color: '#2196F3',
                                    opacity: 0.3
                                }, {
                                    offset: 100,
                                    color: '#2196F3',
                                    opacity: 0
                                }],
                                [{
                                    offset: 0,
                                    color: '#F44336',
                                    opacity: 0.3
                                }, {
                                    offset: 100,
                                    color: '#F44336',
                                    opacity: 0
                                }]
                            ]
                        }
                    },
                    grid: {
                        borderColor: 'var(--border)',
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        }
                    }
                };

                // Xóa biểu đồ cũ nếu đã tồn tại
                if (window.dzchart) {
                    window.dzchart.destroy();
                }

                // Tạo biểu đồ mới
                window.dzchart = new ApexCharts(document.querySelector("#activity"), optionsArea);
                window.dzchart.render();
            }


        });


        // Biểu đồ cột
        var chartBarRunning = function(jobAccess, vacantJob) {
            let months = @json(__('label.admin.dashboard.months'));
            months = months.slice(0, jobAccess.length);
            vacantJob = vacantJob.slice(0, jobAccess.length)
            var options = {
                series: [{
                        name: "{{ __('label.admin.dashboard.job_matching_success') }}",
                        data: jobAccess,
                    },
                    {
                        name: "{{ __('label.admin.dashboard.job_vacant') }}",
                        data: vacantJob,
                    },
                ],
                chart: {
                    type: "bar",
                    height: 350,

                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: "rounded",
                        columnWidth: "45%",
                        borderRadius: 5,
                    },
                },
                colors: ["#", "#77248B"],
                dataLabels: {
                    enabled: false,
                },
                markers: {
                    shape: "circle",
                },
                legend: {
                    show: false,
                    fontSize: "12px",
                    labels: {
                        colors: "#000000",
                    },
                    markers: {
                        width: 30,
                        height: 30,
                        strokeWidth: 0,
                        strokeColor: "#fff",
                        fillColors: undefined,
                        radius: 35,
                    },
                },
                stroke: {
                    show: true,
                    width: 6,
                    colors: ["transparent"],
                },
                grid: {
                    borderColor: "rgba(252, 252, 252,0.2)",
                },
                xaxis: {
                    categories: months,
                    labels: {
                        style: {
                            colors: "#ffffff",
                            fontSize: "13px",
                            fontFamily: "poppins",
                            fontWeight: 100,
                            cssClass: "apexcharts-xaxis-label",
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                        borderType: "solid",
                        color: "#78909C",
                        height: 6,
                        offsetX: 0,
                        offsetY: 0,
                    },
                    crosshairs: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        offsetX: -16,
                        style: {
                            colors: "#ffffff",
                            fontSize: "13px",
                            fontFamily: "poppins",
                            fontWeight: 100,
                            cssClass: "apexcharts-xaxis-label",
                        },
                    },
                },
                fill: {
                    opacity: 1,
                    colors: ["#ffffff", "#FFD125"],
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val;
                        },
                    },
                },
                responsive: [{
                    breakpoint: 575,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: "1%",
                                borderRadius: -1,
                            },
                        },
                        chart: {
                            height: 250,
                        },
                        series: [{
                                name: "Projects",
                                data: [31, 40, 28, 31, 40, 28, 31, 40],
                            },
                            {
                                name: "Projects",
                                data: [11, 32, 45, 31, 40, 28, 31, 40],
                            },
                        ],
                    },
                }, ],
            };

            if (jQuery("#chartBarRunning").length > 0) {
                let chart = new ApexCharts(
                    document.querySelector("#chartBarRunning"),
                    options
                );
                chart.render();

                jQuery("#checkbox2").on("change", function() {
                    jQuery("#dzIncomeSeries").toggleClass("disabled");
                    chart.toggleSeries("{{ __('label.admin.dashboard.job_vacant') }}");
                });

                jQuery("#checkbox3").on("change", function() {
                    jQuery("#dzExpenseSeries").toggleClass("disabled");
                    chart.toggleSeries("{{ __('label.admin.dashboard.job_matching_success') }}");
                });

            }
        };

        // Tròn
        var pieChart = function() {
            var options = {
                series: [(
                        {{ number_format(($totalUserComJobUni['universities'] / ($totalUserComJobUni['universities'] + $totalUserComJobUni['companies'])) * 100, 1) }}),
                    (
                        {{ number_format(($totalUserComJobUni['companies'] / ($totalUserComJobUni['universities'] + $totalUserComJobUni['companies'])) * 100, 1) }})
                ],
                labels: [
                    "{{ __('label.admin.university') }}",
                    "{{ __('label.admin.company') }}"
                ],
                chart: {
                    type: "donut",
                    height: 280,
                    innerRadius: 50,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 0,
                },
                plotOptions: {
                    pie: {
                        startAngle: 0,
                        endAngle: 360,
                        donut: {
                            size: "80%",
                        },
                    },
                },
                colors: ["#ff9800", "#9b61fe"], // Màu sắc của từng phần
                legend: {
                    position: "bottom",
                    show: true, // Hiển thị legend
                },

                tooltip: {
                    enabled: true,
                    y: {
                        formatter: function(val) {
                            return val.toFixed(1) + "%"; // Thêm % vào giá trị tooltip
                        }
                    }
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            width: 200,
                        },
                    },
                }, ],
            };

            var chart = new ApexCharts(document.querySelector("#pieChart"), options);
            chart.render();
        };

        pieChart()

        const totalJobInY = {!! $data !!};
        const totalApply = {!! json_encode($applyJobs) !!};

        function calculateDifference(totalJobs, totalApply) {
            // Chuyển object thành array chứa giá trị của các tháng
            const jobArr = Object.values(totalJobs);
            const applyArr = Object.values(totalApply);

            // Duyệt qua từng tháng và tính hiệu giữa job và apply
            const resultArr = jobArr.map((job, index) => job - (applyArr[index] || 0));

            return resultArr;
        }

        const differenceArray = calculateDifference(totalJobInY, totalApply);
        let totalAppliedJobs = Object.values(totalApply).reduce((a, b) => a + b, 0);
        let totalVacantJobs = differenceArray.reduce((a, b) => a + b, 0);
        document.getElementById('job-m-success').innerText = totalAppliedJobs;
        document.getElementById('job-m-success-big').innerText = totalAppliedJobs;
        document.getElementById('job-vacant').innerText = totalVacantJobs;
        document.getElementById('job-vacant-big').innerText = totalVacantJobs;
        chartBarRunning(Object.values(totalApply), differenceArray)


        function changeActiveState(selectedElement) {
            // Find all elements with class "active" and remove the class
            document.querySelectorAll(".dropdown-item.active").forEach((el) => {
                el.classList.remove("active");
            });

            // Add "active" class to the selected element
            selectedElement.classList.add("active");
        }
    </script>

@endsection
