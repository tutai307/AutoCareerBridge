@extends('management.layout.main')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('management-assets/css/admins/home.css') }}">
    <link rel="stylesheet" href="{{ asset('management-assets/css/companies/dashboard.css') }}">

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
                                    <h2 class="mb-0">{{ $totalStudentWorkshopColabJob['totalStudents'] ?? 0 }}</h2>
                                    <p class="mb-0">{{ __('label.university.dashboard.total_student') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-buildings" style="font-size: 22px;"></i>
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{ $totalStudentWorkshopColabJob['totalUniversityJobs'] ?? 0 }}</h2>
                                    <p class="mb-0">{{ __('label.university.dashboard.total_job') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-briefcase" style="font-size: 22px;"></i>
                                </div>
                                <div class="chart-num">
                                    <h2 class="font-w600 mb-0">
                                        {{ $totalStudentWorkshopColabJob['totalCollaborations'] ?? 0 }}</h2>
                                    <p class="mb-0">{{ __('label.university.dashboard.total_collaboration') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-building" style="font-size: 22px;"></i>
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{ $totalStudentWorkshopColabJob['totalWorkshops'] ?? 0 }}</h2>
                                    <p class="mb-0">{{ __('label.university.dashboard.total_workshop') }}</p>
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
                                    <h2 class="card-title">{{ __('label.university.dashboard.title_chart') }}</h2>
                                </div>
                                <div class="d-flex align-items-center mb-3 mb-sm-0">
                                    <div class="round jobpending" id="dzNewSeries">
                                        <div>
                                            <input type="checkbox" id="jobPendingInput" checked name="radio"
                                                value="monthly">
                                            <label for="jobPendingInput" class="checkmark job_pending"></label>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ __('label.university.dashboard.workshop_pending') }}</p>
                                            <h6 class="mb-0" id="jobPending">1.982</h6>
                                        </div>
                                    </div>
                                    <div class="round " id="dzNewSeries">
                                        <div>
                                            <input type="checkbox" id="checkbox" checked name="radio" value="monthly">
                                            <label for="checkbox" class="checkmark job_aproved"></label>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ __('label.university.dashboard.workshop_approved') }}</p>
                                            <h6 class="mb-0" id="jobAproved">1.982</h6>
                                        </div>
                                    </div>
                                    <div class="round weekly" id="dzOldSeries">
                                        <div>
                                            <input type="checkbox" checked id="checkbox1" name="radio" value="weekly">
                                            <label for="checkbox1" class="checkmark"></label>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ __('label.university.dashboard.workshop_reject') }}</p>
                                            <h6 class="mb-0" id="jobRejectd">1.982</h6>
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

                                    <select class="bootstrap-select image-select default-select dashboard-select "
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
                            <h2 class="card-title">{{ __('label.university.dashboard.company_and_workshop') }}
                            </h2>
                        </div>
                        <div class="card-body text-center pt-0 pb-2">
                            <div id="pieChart" class="d-inline-block" style="min-height: 185px;">
                                @php
                                    $total =
                                        $totalStudentWorkshopColabJob['totalCollaborations'] +
                                        $totalStudentWorkshopColabJob['totalWorkshops'];
                                    $collaborationPercentage =
                                        $total > 0
                                            ? ($totalStudentWorkshopColabJob['totalCollaborations'] / $total) * 100
                                            : 0;
                                    $workShopPercentage =
                                        $total > 0
                                            ? ($totalStudentWorkshopColabJob['totalWorkshops'] / $total) * 100
                                            : 0;
                                @endphp
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
                                                            fill="#ff9800"></rect>
                                                    </svg>
                                                    {{ __('label.university.dashboard.workshop') }}
                                                    ({{ number_format($workShopPercentage, 1) }}%)
                                                </p>
                                                <h6 class="mb-0">{{ $totalStudentWorkshopColabJob['totalWorkshops'] }}
                                                </h6>
                                            </div>
                                            <div class="color-picker">
                                                <p class="mb-0  text-gray">
                                                    <svg class="me-2" width="14" height="14"
                                                        viewBox="0 0 14 14" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4"
                                                            fill="#9568FF"></rect>
                                                    </svg>
                                                    {{ __('label.university.dashboard.company') }}
                                                    ({{ number_format($collaborationPercentage, 1) }}%)
                                                </p>
                                                <h6 class="mb-0">
                                                    {{ $totalStudentWorkshopColabJob['totalCollaborations'] }}</h6>
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var pieChart = function() {
            var workShopPercentage = {{ $workShopPercentage ?? 0 }};
            var collaborationPercentage = {{ $collaborationPercentage ?? 0 }};

            if (isNaN(workShopPercentage)) workShopPercentage = 0;
            if (isNaN(collaborationPercentage)) collaborationPercentage = 0;

            var options = {
                series: [workShopPercentage, collaborationPercentage],
                labels: ["{{ __('label.university.dashboard.workshop') }}",
                    "{{ __('label.university.dashboard.company') }}",
                ],
                chart: {
                    type: "donut",
                    height: 280,
                },

                stroke: {
                    width: 0, // Không viền
                },
                dataLabels: {
                    enabled: false,
                },
                plotOptions: {
                    pie: {
                        startAngle: 0,
                        endAngle: 360,
                        donut: {
                            size: "80%", // Kích thước của phần donut
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

            // Tạo biểu đồ
            var chart = new ApexCharts(document.querySelector("#pieChart"), options);
            chart.render();
        };

        pieChart()

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
                    console.log(formattedToday);

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
                            toastr.error("", "{{ __('message.date_start_than_end') }}", {
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
                            toastr.error("", "{{ __('message.date_end_than_start') }}", {
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
                    url: "{{ route('university.getChartWorkshop') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        previousDate: formattedPreviousDate,
                        currentDate: formattedCurrentDate,
                    },
                    success: function(response) {
                        let totalPending = response.workshopPending.reduce((a, b) => a + b, 0);
                        let totalApproved = response.workApperoved.reduce((a, b) => a + b, 0);
                        let totalRejected = response.workshopReject.reduce((a, b) => a + b, 0);

                        // Cập nhật biểu đồ
                        updateChart(response.workshopPending, response.workApperoved, response
                            .workshopReject,
                            response.date,
                            totalPending,
                            totalApproved,
                            totalRejected,
                        );
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                    }
                });
            }

            // Hàm cập nhật hoặc tạo biểu đồ
            function updateChart(jobPending, jobApperoved, jobReject, date, totalJobPending, totalApproved,
                totalRejected) {
                $("#jobPending").text(totalJobPending);
                $("#jobAproved").text(totalApproved);
                $("#jobRejectd").text(totalRejected);

                // Kiểm tra dữ liệu trước khi tạo biểu đồ
                if (!date || date.length === 0) {
                    date = ["{{ __('label.university.dashboard.no_data') }}"];
                    jobPending = [0];
                    jobApperoved = [0];
                    jobReject = [0];
                }

                var optionsArea = {
                    series: [{
                            name: "{{ __('label.university.dashboard.workshop_pending') }}",
                            color: '#ff9800', // Màu cam sáng
                            data: jobPending,
                        },
                        {
                            name: "{{ __('label.university.dashboard.workshop_approved') }}",
                            color: '#2196F3', // Màu xanh dương
                            data: jobApperoved,
                        },
                        {
                            name: "{{ __('label.university.dashboard.workshop_reject') }}",
                            color: '#F44336', // Màu đỏ
                            data: jobReject,
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
                        width: [4, 4, 4],
                        curve: 'smooth',
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
                        size: [8, 8, 8],
                        strokeWidth: [4, 4, 4],
                        strokeColors: ['#ff9800', '#2196F3', '#F44336'],
                        colors: ['#fff', '#fff', '#fff'],
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
                                    color: '#ff9800',
                                    opacity: 0.3
                                }, {
                                    offset: 100,
                                    color: '#ff9800',
                                    opacity: 0
                                }],
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
    </script>

@endsection
